def delete(source_name, size, metadata_backend=None, storage_backend=None):
    """
    Deletes a thumbnail file and its relevant metadata.
    """
    if storage_backend is None:
        storage_backend = backends.storage.get_backend()
    if metadata_backend is None:
        metadata_backend = backends.metadata.get_backend()
    storage_backend.delete(get_thumbnail_name(source_name, size))
    metadata_backend.delete_thumbnail(source_name, size)