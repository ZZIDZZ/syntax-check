func (s *storageCeph) copyWithoutSnapshotsSparse(target container,
	source container) error {
	logger.Debugf(`Creating sparse copy of RBD storage volume for container "%s" to "%s" without snapshots`, source.Name(),
		target.Name())

	sourceIsSnapshot := source.IsSnapshot()
	sourceContainerName := projectPrefix(source.Project(), source.Name())
	targetContainerName := projectPrefix(target.Project(), target.Name())
	sourceContainerOnlyName := sourceContainerName
	sourceSnapshotOnlyName := ""
	snapshotName := fmt.Sprintf("zombie_snapshot_%s",
		uuid.NewRandom().String())
	if sourceIsSnapshot {
		sourceContainerOnlyName, sourceSnapshotOnlyName, _ =
			containerGetParentAndSnapshotName(sourceContainerName)
		snapshotName = fmt.Sprintf("snapshot_%s", sourceSnapshotOnlyName)
	} else {
		// create snapshot
		err := cephRBDSnapshotCreate(s.ClusterName, s.OSDPoolName,
			sourceContainerName, storagePoolVolumeTypeNameContainer,
			snapshotName, s.UserName)
		if err != nil {
			logger.Errorf(`Failed to create snapshot for RBD storage volume for image "%s" on storage pool "%s": %s`, targetContainerName, s.pool.Name, err)
			return err
		}
	}

	// protect volume so we can create clones of it
	err := cephRBDSnapshotProtect(s.ClusterName, s.OSDPoolName,
		sourceContainerOnlyName, storagePoolVolumeTypeNameContainer,
		snapshotName, s.UserName)
	if err != nil {
		logger.Errorf(`Failed to protect snapshot for RBD storage volume for image "%s" on storage pool "%s": %s`, snapshotName, s.pool.Name, err)
		return err
	}

	err = cephRBDCloneCreate(s.ClusterName, s.OSDPoolName,
		sourceContainerOnlyName, storagePoolVolumeTypeNameContainer,
		snapshotName, s.OSDPoolName, targetContainerName,
		storagePoolVolumeTypeNameContainer, s.UserName)
	if err != nil {
		logger.Errorf(`Failed to clone new RBD storage volume for container "%s": %s`, targetContainerName, err)
		return err
	}

	// Re-generate the UUID
	err = s.cephRBDGenerateUUID(projectPrefix(target.Project(), target.Name()), storagePoolVolumeTypeNameContainer)
	if err != nil {
		return err
	}

	// Create mountpoint
	targetContainerMountPoint := getContainerMountPoint(target.Project(), s.pool.Name, target.Name())
	err = createContainerMountpoint(targetContainerMountPoint, target.Path(), target.IsPrivileged())
	if err != nil {
		return err
	}

	ourMount, err := target.StorageStart()
	if err != nil {
		return err
	}
	if ourMount {
		defer target.StorageStop()
	}

	err = target.TemplateApply("copy")
	if err != nil {
		logger.Errorf(`Failed to apply copy template for container "%s": %s`, target.Name(), err)
		return err
	}
	logger.Debugf(`Applied copy template for container "%s"`, target.Name())

	logger.Debugf(`Created sparse copy of RBD storage volume for container "%s" to "%s" without snapshots`, source.Name(),
		target.Name())
	return nil
}