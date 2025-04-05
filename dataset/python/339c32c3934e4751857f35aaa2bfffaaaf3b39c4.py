def reasonable_desired_version(self, desired_version, allow_equal=False,
                                  allow_patch_skip=False):
        """
        Determine whether the desired version is a reasonable next version.

        Parameters
        ----------
        desired_version: str
            the proposed next version name
        """
        try:
            desired_version = desired_version.base_version
        except:
            pass
        (new_major, new_minor, new_patch) = \
                map(int, desired_version.split('.'))

        tag_versions = self._versions_from_tags()
        if not tag_versions:
            # no tags yet, and legal version is legal!
            return ""
        max_version = max(self._versions_from_tags()).base_version
        (old_major, old_minor, old_patch) = \
                map(int, str(max_version).split('.'))

        update_str = str(max_version) + " -> " + str(desired_version)

        v_desired = vers.Version(desired_version)
        v_max = vers.Version(max_version)

        if allow_equal and v_desired == v_max:
            return ""

        if v_desired < v_max:
            return ("Bad update: New version doesn't increase on last tag: "
                    + update_str + "\n")

        bad_update = skipped_version((old_major, old_minor, old_patch),
                                     (new_major, new_minor, new_patch),
                                     allow_patch_skip)

        msg = ""
        if bad_update:
            msg = ("Bad update: Did you skip a version from "
                   + update_str + "?\n")

        return msg