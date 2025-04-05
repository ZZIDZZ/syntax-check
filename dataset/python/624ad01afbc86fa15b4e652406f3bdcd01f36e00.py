def get_social_login(self, *args, **kwargs):
        """
        Set the social login process state to connect rather than login
        Refer to the implementation of get_social_login in base class and to the
        allauth.socialaccount.helpers module complete_social_login function.
        """
        social_login = super(SocialConnectMixin, self).get_social_login(*args, **kwargs)
        social_login.state['process'] = AuthProcess.CONNECT
        return social_login