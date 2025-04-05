def export(self, metadata, **kwargs):
        "Turn metadata into JSON"
        kwargs.setdefault('indent', 4)
        metadata = json.dumps(metadata, **kwargs)
        return u(metadata)