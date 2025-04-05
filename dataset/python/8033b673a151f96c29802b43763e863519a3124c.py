def get_field(self, field_name, args, kwargs):
        """
        Return an underscore if the attribute is absent.
        Not all components have the same attributes.
        """
        try:
            s = super(CustomFormatter, self)
            return s.get_field(field_name, args, kwargs)
        except KeyError:    # Key is missing
            return ("_", field_name)
        except IndexError:  # Value is missing
            return ("_", field_name)