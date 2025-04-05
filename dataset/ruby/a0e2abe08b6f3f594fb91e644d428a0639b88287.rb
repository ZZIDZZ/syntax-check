def client_login_authorization_header(http_method, uri)
      if @user && @password && !@auth_token
        email            = CGI.escape(@user)
        password         = CGI.escape(@password)
        http             = Net::HTTP.new('www.google.com', 443)
        http.use_ssl     = true
        http.verify_mode = OpenSSL::SSL::VERIFY_NONE
        resp, data = http.post('/accounts/ClientLogin',
                               "accountType=HOSTED_OR_GOOGLE&Email=#{email}&Passwd=#{password}&service=wise",
                               { 'Content-Type' => 'application/x-www-form-urlencoded' })
        handle_response(resp)
        @auth_token = (data || resp.body)[/Auth=(.*)/n, 1]
      end
      @auth_token ? { 'Authorization' => "GoogleLogin auth=#{@auth_token}" } : {}
    end