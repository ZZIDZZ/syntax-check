def my_permission_factory(record, *args, **kwargs):
    """My permission factory."""
    def can(self):
        rec = Record.get_record(record.id)
        return rec.get('access', '') == 'open'
    return type('MyPermissionChecker', (), {'can': can})()