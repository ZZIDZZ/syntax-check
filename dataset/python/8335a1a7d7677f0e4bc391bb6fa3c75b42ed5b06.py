def has_waveform_packet(self):
        """ Returns True if the point format has waveform packet dimensions
        """
        dimensions = set(self.dimension_names)
        return all(name in dimensions for name in dims.WAVEFORM_FIELDS_NAMES)