def _init_transformer(cls, data):
        """Convert input into a QuantumChannel subclass object or Operator object"""
        # This handles common conversion for all QuantumChannel subclasses.
        # If the input is already a QuantumChannel subclass it will return
        # the original object
        if isinstance(data, QuantumChannel):
            return data
        if hasattr(data, 'to_quantumchannel'):
            # If the data object is not a QuantumChannel it will give
            # preference to a 'to_quantumchannel' attribute that allows
            # an arbitrary object to define its own conversion to any
            # quantum channel subclass.
            return data.to_channel()
        if hasattr(data, 'to_channel'):
            # TODO: this 'to_channel' method is the same case as the above
            # but is used by current version of Aer. It should be removed
            # once Aer is nupdated to use `to_quantumchannel`
            # instead of `to_channel`,
            return data.to_channel()
        # Finally if the input is not a QuantumChannel and doesn't have a
        # 'to_quantumchannel' conversion method we try and initialize it as a
        # regular matrix Operator which can be converted into a QuantumChannel.
        return Operator(data)