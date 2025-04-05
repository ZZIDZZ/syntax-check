def sign_package params
      params_str = create_sign_str params

      if params_str =~ /trade_type=APP/
        key = Wxpay.app_api_key
      else
        key = Wxpay.api_key
      end
      Digest::MD5.hexdigest(params_str+"&key=#{key}").upcase
    end