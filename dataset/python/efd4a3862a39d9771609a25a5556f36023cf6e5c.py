def hashes_match(self, dep_tree):
        """
        Compares the app deptree file hashes with the hashes stored in the
        cache.
        """
        hashes = self.get_hashes()
        for module, info in dep_tree.items():
            md5 = self.get_hash(info['path'])
            if md5 != hashes[info['path']]:
                return False
        return True