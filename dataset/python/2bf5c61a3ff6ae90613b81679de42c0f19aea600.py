def add_from_depend(self, node, from_module):
        """add dependencies created by from-imports
        """
        mod_name = node.root().name
        obj = self.module(mod_name)
        if from_module not in obj.node.depends:
            obj.node.depends.append(from_module)