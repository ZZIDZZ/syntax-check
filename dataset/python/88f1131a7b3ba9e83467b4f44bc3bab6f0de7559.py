def _observe__children(self, change):
        """ When the children of the block change. Update the referenced
        block.
        
        """
        if not self.is_initialized or change['type'] != 'update':
            return

        block = self.block
        new_children = change['value']
        old_children = change['oldvalue']
        for c in old_children:
            if c not in new_children and not c.is_destroyed:
                c.destroy()
            else:
                c.set_parent(None)
                
        if block:
            # This block is inserting into another block
            before = None
            if self.mode == 'replace':
                block.children = []
            if self.mode == 'prepend' and block.children:
                before = block.children[0]
            block.insert_children(before, new_children)
        else:
            # This block is a placeholder
            self.parent.insert_children(self, new_children)