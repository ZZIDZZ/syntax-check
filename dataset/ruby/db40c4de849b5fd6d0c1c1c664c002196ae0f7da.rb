def request(http_verb, url, options = {})
      full_url = url + hash_to_params(options)
      handle(access_token.request(http_verb, full_url))
    end