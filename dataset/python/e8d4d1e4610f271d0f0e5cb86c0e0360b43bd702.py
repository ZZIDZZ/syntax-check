def remove_leaf_names(self):
        """
        Set the name of all leaf nodes in the subtree to None.
        """
        self.visit(lambda n: setattr(n, 'name', None), lambda n: n.is_leaf)