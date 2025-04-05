public function create(string $repoName) {
    $this->getGithubAuthentication()->authenticate();
    $this->getRepositoryApi()->create($repoName, '', '', true, $this->getOrganization(), true, true, true);
  }