public function getFile($file_hash) {
    $entity = $this->getSubscribeFileEntity('file_hash', $file_hash);
    $this->checkLinkActive($entity);
    $file = File::load($entity->get('fid')->getValue()[0]['value']);
    $uri = $file->getFileUri();
    $response = new BinaryFileResponse($uri);
    $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
    return $response;
  }