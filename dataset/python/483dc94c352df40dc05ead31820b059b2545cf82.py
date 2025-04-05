def get_member(self, id='me', name=None):
        '''
        Get a member or your current member if `id` wasn't given.

        Returns:
            Member: The member with the given `id`, defaults to the
            logged in member.
        '''
        return self.create_member(dict(id=id, fullName=name))