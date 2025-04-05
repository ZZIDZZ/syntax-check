function upgradeSchema(nativeDatabase, nativeTransaction, descriptors) {
  let objectStoreNames = Array.from(nativeDatabase.objectStoreNames)
  let newObjectStoreNames = descriptors.map((objectStore) => {
    return objectStore.name
  })
  objectStoreNames.forEach((objectStoreName) => {
    if (newObjectStoreNames.indexOf(objectStoreName) === -1) {
      nativeDatabase.deleteObjectStore(objectStoreName)
    }
  })

  descriptors.forEach((objectStoreDescriptor) => {
    let objectStoreName = objectStoreDescriptor.name
    let nativeObjectStore = objectStoreNames.indexOf(objectStoreName) > -1 ?
        nativeTransaction.objectStore(objectStoreName) : null

    let objectStoreMigrator = new ObjectStoreMigrator(nativeDatabase,
        nativeObjectStore, objectStoreDescriptor)
    objectStoreMigrator.executeMigration()
  })
}