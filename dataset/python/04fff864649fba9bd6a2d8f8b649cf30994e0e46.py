def str_to_num(str_value):
        """Convert str_value to an int or a float, depending on the
        numeric value represented by str_value.

        """
        str_value = str(str_value)
        try:
            return int(str_value)
        except ValueError:
            return float(str_value)