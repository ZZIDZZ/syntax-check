def print_details(self):
        """Print a summary of the game details."""
        print 'Map      ', self.map
        print 'Duration ', self.duration
        print 'Version  ', self.version
        print 'Team  Player       Race       Color'
        print '-----------------------------------'
        for player in self.players:
            print '{team:<5} {name:12} {race:10} {color}'.format(**player)