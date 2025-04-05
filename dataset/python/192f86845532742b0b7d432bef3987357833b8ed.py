def unregister_block(self, block_type):
        """
        Unregisters the block associated with `block_type` from the registry.

        If no block is registered to `block_type`, NotRegistered will raise.
        """
        if block_type not in self._registry:
            raise NotRegistered(
                'There is no block registered as "{}" with the '
                'RegisteredBlockStreamFieldRegistry registry.'.format(
                    block_type
                )
            )
        else:
            del self._registry[block_type]