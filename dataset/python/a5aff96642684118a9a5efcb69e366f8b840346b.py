def dispose(json_str):
    """Clear all comments in json_str.

    Clear JS-style comments like // and /**/ in json_str.
    Accept a str or unicode as input.

    Args:
        json_str: A json string of str or unicode to clean up comment

    Returns:
        str: The str without comments (or unicode if you pass in unicode)
    """
    result_str = list(json_str)
    escaped = False
    normal = True
    sl_comment = False
    ml_comment = False
    quoted = False

    a_step_from_comment = False
    a_step_from_comment_away = False

    former_index = None

    for index, char in enumerate(json_str):

        if escaped:  # We have just met a '\'
            escaped = False
            continue

        if a_step_from_comment:  # We have just met a '/'
            if char != '/' and char != '*':
                a_step_from_comment = False
                normal = True
                continue

        if a_step_from_comment_away:  # We have just met a '*'
            if char != '/':
                a_step_from_comment_away = False

        if char == '"':
            if normal and not escaped:
                # We are now in a string
                quoted = True
                normal = False
            elif quoted and not escaped:
                # We are now out of a string
                quoted = False
                normal = True

        elif char == '\\':
            # '\' should not take effect in comment
            if normal or quoted:
                escaped = True

        elif char == '/':
            if a_step_from_comment:
                # Now we are in single line comment
                a_step_from_comment = False
                sl_comment = True
                normal = False
                former_index = index - 1
            elif a_step_from_comment_away:
                # Now we are out of comment
                a_step_from_comment_away = False
                normal = True
                ml_comment = False
                for i in range(former_index, index + 1):
                    result_str[i] = ""

            elif normal:
                # Now we are just one step away from comment
                a_step_from_comment = True
                normal = False

        elif char == '*':
            if a_step_from_comment:
                # We are now in multi-line comment
                a_step_from_comment = False
                ml_comment = True
                normal = False
                former_index = index - 1
            elif ml_comment:
                a_step_from_comment_away = True
        elif char == '\n':
            if sl_comment:
                sl_comment = False
                normal = True
                for i in range(former_index, index + 1):
                    result_str[i] = ""
        elif char == ']' or char == '}':
            if normal:
                _remove_last_comma(result_str, index)

    # Show respect to original input if we are in python2
    return ("" if isinstance(json_str, str) else u"").join(result_str)