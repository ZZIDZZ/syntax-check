Optional<BigInteger> loadStores(Function<String, EntityStores> entityStoresByStoreName,
                                    BiFunction<SerializableSnapshot, String, SerializableSnapshot> snapshotPostProcessor) {
        Optional<BigInteger> latestSnapshotTxId;
        try {
            latestSnapshotTxId = m_snapshotStore.listSnapshots().stream().max(BigInteger::compareTo);
        } catch (IOException e) {
            throw new UnrecoverableStoreException("Error occurred when recovering from latest snapshot", e);
        }

        latestSnapshotTxId.ifPresent(lastTx -> {
            LOG.info("Recovering store from snapshot", args -> args.add("transactionId", lastTx));
            var postProcess = new SnapshotPostProcessor(snapshotPostProcessor);
            try {
                Flowable.fromPublisher(m_snapshotStore.createSnapshotReader(lastTx))  //
                        .blockingForEach(reader -> {
                            String storeName = reader.storeName();
                            EntityStores entityStores = entityStoresByStoreName.apply(storeName);

                            SerializableSnapshot serializableSnapshot;
                            try (InputStream is = reader.inputStream()) {
                                serializableSnapshot = m_snapshotSerializer.deserializeSnapshot(storeName, is);
                            }
                            if (serializableSnapshot.getSnapshotModelVersion() != SNAPSHOT_MODEL_VERSION) {
                                throw new UnrecoverableStoreException("Snapshot serializable model version is not supported",
                                                                      args -> args.add("version", serializableSnapshot.getSnapshotModelVersion())
                                                                              .add("expectedVersion", SNAPSHOT_MODEL_VERSION));
                            }

                            if (!lastTx.equals(serializableSnapshot.getTransactionId())) {
                                throw new UnrecoverableStoreException("Snapshot transaction id  mismatch with request transaction id",
                                                                      args -> args.add("snapshotTransactionId", serializableSnapshot.getTransactionId())
                                                                              .add("requestTransactionId", lastTx));
                            }

                            SerializableSnapshot finalSnapshot = postProcess.apply(storeName, serializableSnapshot);

                            finalSnapshot.getEntities().forEach(serializableEntityInstances -> {
                                String entityName = serializableEntityInstances.getEntityName();
                                EntityStore<?> entityStore = entityStores.getEntityStore(entityName);
                                checkArgument(entityStore != null, "Entity has not be registered in the store", args -> args.add("entityName", entityName));

                                entityStore.recover(serializableEntityInstances);
                            });
                        });
            } catch (Exception e) {
                throw new UnrecoverableStoreException("Error occurred when recovering from latest snapshot", e);
            }

            // update the applicationModelVersion if any consistent load/update
            m_applicationModelVersion = postProcess.getConsistentApplicationModelVersion();
        });

        if (!latestSnapshotTxId.isPresent()) {
            LOG.info("Store has no snapshot, store is empty, creating it's first snapshot");
        }

        return latestSnapshotTxId;
    }