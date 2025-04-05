def get_pull_requests(app, repo_config):
    """Last 30 pull requests from a repository.

    :param app: Flask app
    :param repo_config: dict with ``github_repo`` key

    :returns: id for a pull request
    """
    response = get_api_response(app, repo_config, "/repos/{repo_name}/pulls")
    if not response.ok:
        raise Exception("Unable to get pull requests: status code {}".format(response.status_code))
    return (item for item in response.json)