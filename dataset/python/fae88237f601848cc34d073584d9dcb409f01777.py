def import_patches(self, patches):
        """ Import several patches into the patch queue """

        dest_dir = self.quilt_patches
        patch_names = []

        for patch in patches:
            patch_name = os.path.basename(patch)
            patch_file = File(patch)
            dest_file = dest_dir + File(patch_name)
            patch_file.copy(dest_file)
            patch_names.append(patch_name)

        self._import_patches(patch_names)