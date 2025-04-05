def descendant(self, chain_path):
        """ A descendant is a child many steps down.
        """
        public_child = self.hdkeychain
        chain_step_bytes = 4
        max_bits_per_step = 2**31
        chain_steps = [
            int(chain_path[i:i+chain_step_bytes*2], 16) % max_bits_per_step
            for i in range(0, len(chain_path), chain_step_bytes*2)
        ]
        for step in chain_steps:
            public_child = public_child.get_child(step)

        return PublicKeychain(public_child)