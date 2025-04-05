public function cloneMedia($media, $clone_storage = false, $clone_attributes = []) {
    $this->media = $media->replicate();
    $this->setup();
    $this->filename_new = basename($media->filename);

    if ($clone_storage) {
      $this->fileExistsRename();
      $this->storageClone();
    }

    $this->media->fill($clone_attributes);
    $this->media->filename = $this->directory_uri . $this->filename_new;

    return $this->media()->save($this->media);
  }