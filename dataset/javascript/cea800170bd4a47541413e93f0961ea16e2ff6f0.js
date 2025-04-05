function createGitRepository(basePath, options) {
    if (typeof (options) === "undefined")
        options = defaultRepositoryOptions;

    var gitRepository = new GitRepository();
    configureGitRepository(gitRepository, basePath, options);
    return gitRepository;
}