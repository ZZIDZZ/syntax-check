def tables(auth=None, eager=True):
    """Returns a list of tables for the given user."""
    auth = auth or []
    dynamodb = boto.connect_dynamodb(*auth)

    return [table(t, auth, eager=eager) for t in dynamodb.list_tables()]