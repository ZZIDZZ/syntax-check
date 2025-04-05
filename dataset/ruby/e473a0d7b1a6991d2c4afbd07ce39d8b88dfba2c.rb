def request_trust(trust_url = "http://#{request.host}/", *args)
      trust_url = url_for(trust_url.merge(:only_path => false)) if trust_url.kind_of?(Hash)
      javascript_tag "CCPEVE.requestTrust(#{trust_url.inspect});", *args
    end