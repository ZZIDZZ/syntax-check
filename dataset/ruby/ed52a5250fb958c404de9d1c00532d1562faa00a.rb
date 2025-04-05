def reset!
      self.client_id          = DEFAULT_CLIENT_ID
      self.client_secret      = DEFAULT_CLIENT_SECRET
      self.oauth_token        = DEFAULT_OAUTH_TOKEN
      self.endpoint           = DEFAULT_ENDPOINT
      self.site               = DEFAULT_SITE
      self.ssl                = DEFAULT_SSL
      self.user_agent         = DEFAULT_USER_AGENT
      self.connection_options = DEFAULT_CONNECTION_OPTIONS
      self.mime_type          = DEFAULT_MIME_TYPE
      self.login              = DEFAULT_LOGIN
      self.password           = DEFAULT_PASSWORD
      self.basic_auth         = DEFAULT_BASIC_AUTH
      self.auto_pagination    = DEFAULT_AUTO_PAGINATION
      self.content_locale     = DEFAULT_CONTENT_LOCALE
      self.adapter            = DEFAULT_ADAPTER
      self.subdomain          = DEFAULT_SUBDOMAIN
      self
    end