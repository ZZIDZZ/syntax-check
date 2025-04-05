def redirect_to(url, options={})
      full_url = absolute_url(url, options)
      response[LOCATION] = full_url
      respond_with 302
      full_url
    end