def connect(self):
        """Initializes the connection attribute with the path to the user home folder's Music folder, and creates it if it doesn't exist."""

        if self.music_folder is None:
            music_folder = os.path.join(os.path.expanduser('~'), 'Music')
            if not os.path.exists(music_folder):
                os.makedirs(music_folder)
            self.music_folder = music_folder