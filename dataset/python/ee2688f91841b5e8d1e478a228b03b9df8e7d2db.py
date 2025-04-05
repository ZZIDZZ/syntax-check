def parse_commit(parts):
    '''Accept a parsed single commit. Some of the named groups
    require further processing, so parse those groups.
    Return a dictionary representing the completely parsed
    commit.
    '''
    commit = {}
    commit['commit'] = parts['commit']
    commit['tree'] = parts['tree']
    parent_block = parts['parents']
    commit['parents'] = [
        parse_parent_line(parentline)
        for parentline in
        parent_block.splitlines()
    ]
    commit['author'] = parse_author_line(parts['author'])
    commit['committer'] = parse_committer_line(parts['committer'])
    message_lines = [
        parse_message_line(msgline)
        for msgline in
        parts['message'].split("\n")
    ]
    commit['message'] = "\n".join(
        msgline
        for msgline in
        message_lines
        if msgline is not None
    )
    commit['changes'] = [
        parse_numstat_line(numstat)
        for numstat in
        parts['numstats'].splitlines()
    ]
    return commit