def get_invalid_examples(self):
        """Return a list of examples which violate the schema."""
        path = os.path.join(self._get_schema_folder(), "examples", "invalid")
        return list(_get_json_content_from_folder(path))