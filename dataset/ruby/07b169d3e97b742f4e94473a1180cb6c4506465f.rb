def head_and_get(path, codes = [200], params = {})
      url_to_get  = url(path)
      head_params = (params[:head] || {}).merge(head_or_get_params)

      head_res = NS::Browser.forge_request(url_to_get, head_params).run

      codes.include?(head_res.code) ? NS::Browser.get(url_to_get, params[:get] || {}) : head_res
    end