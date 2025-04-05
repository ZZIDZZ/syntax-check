def get_global_settings(self):
        """
        Return a dictionary of all global_settings values.
        """
        return dict((key, getattr(global_settings, key)) for key in dir(global_settings)
                    if key.isupper())