def is_effective_member(self, group_id, netid):
        """
        Returns True if the netid is in the group, False otherwise.
        """
        self._valid_group_id(group_id)

        # GWS doesn't accept EPPNs on effective member checks, for UW users
        netid = re.sub('@washington.edu', '', netid)

        url = "{}/group/{}/effective_member/{}".format(self.API,
                                                       group_id,
                                                       netid)

        try:
            data = self._get_resource(url)
            return True  # 200
        except DataFailureException as ex:
            if ex.status == 404:
                return False
            else:
                raise