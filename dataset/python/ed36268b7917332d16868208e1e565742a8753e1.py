def upgrade(db_url, revision):
    """
    Upgrade the given database to revision.
    """
    with temp_alembic_ini(ALEMBIC_DIR_LOCATION, db_url) as alembic_ini:
        subprocess.check_call(
            ['alembic', '-c', alembic_ini, 'upgrade', revision]
        )