def get_game_dir(self, username=False):
        """Returns joined game directory path relative to Steamapps"""
        if not self.common and not username:
            raise RuntimeError("Can't determine this game's directory without username")
        if self.common:
            subdir = "common"
        else:
            subdir = "username"
        subsubdir = self.dir
        if WIN32 or CYGWIN:
            subsubdir = subsubdir.lower()
        return os.path.join(subdir, subsubdir)