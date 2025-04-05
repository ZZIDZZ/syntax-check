def find_path(name, config, wsonly=False):
    """Find path for given workspace and|or repository."""
    workspace = Workspace(config)
    config = config["workspaces"]

    path_list = {}

    if name.find('/') != -1:
        wsonly = False
        try:
            ws, repo = name.split('/')
        except ValueError:
            raise ValueError("There is too many / in `name` argument. "
                             "Argument syntax: `workspace/repository`.")
        if (workspace.exists(ws)):
            if (repo in config[ws]["repositories"]):
                path_name = "%s/%s" % (ws, repo)
                path_list[path_name] = config[ws]["repositories"][repo]

    for ws_name, ws in sorted(config.items()):
        if (name == ws_name):
            if wsonly is True:
                return {ws_name: ws["path"]}
            repositories = sorted(config[ws_name]["repositories"].items())
            for name, path in repositories:
                path_list["%s/%s" % (ws_name, name)] = path
            break

        for repo_name, repo_path in sorted(ws["repositories"].items()):
            if (repo_name == name):
                path_list["%s/%s" % (ws_name, repo_name)] = repo_path

    return path_list