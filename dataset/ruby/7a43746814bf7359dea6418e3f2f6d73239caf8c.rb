def authorize(auth = {})
      @authentication ||= TaskMapper::Authenticator.new(auth)
      auth = @authentication
      if (auth.account.nil? and auth.subdomain.nil?) or auth.username.nil? or auth.password.nil?
        raise "Please provide at least an account (subdomain), username and password)"
      end
      UnfuddleAPI.protocol = auth.protocol if auth.protocol?
      UnfuddleAPI.account = auth.account || auth.subdomain
      UnfuddleAPI.authenticate(auth.username, auth.password)
    end