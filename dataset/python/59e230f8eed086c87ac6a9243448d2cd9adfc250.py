def get_prep_value(self, value):
        """
        Convert an Enum value into a string for the database
        """
        if value is None:
            return None
        if isinstance(value, self.enum):
            return value.name
        raise ValueError("Unknown value {value:r} of type {cls}".format(
            value=value, cls=type(value)))