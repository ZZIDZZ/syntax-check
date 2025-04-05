def has_delete_permission(self, request, obj=None):
        """
        Implement a lookup for object level permissions. Basically the same as
        ModelAdmin.has_delete_permission, but also passes the obj parameter in.
        """
        if settings.TREE_EDITOR_OBJECT_PERMISSIONS:
            opts = self.opts
            r = request.user.has_perm(opts.app_label + '.' + opts.get_delete_permission(), obj)
        else:
            r = True

        return r and super(TreeEditor, self).has_delete_permission(request, obj)