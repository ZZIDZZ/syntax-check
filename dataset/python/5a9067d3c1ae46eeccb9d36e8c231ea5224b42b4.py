def parse_emails(values):
    '''
    Take a string or list of strings and try to extract all the emails
    '''
    emails = []
    if isinstance(values, str):
        values = [values]
    # now we know we have a list of strings
    for value in values:
        matches = re_emails.findall(value)
        emails.extend([match[2] for match in matches])
    return emails