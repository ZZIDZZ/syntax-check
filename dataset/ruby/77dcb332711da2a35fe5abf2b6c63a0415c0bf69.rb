def get_endpoints(token = nil)
                  if token.nil?
                          return get_request(address("/endpoints"), token())
                  else
                          return get_request(address("/tokens/#{token}/endpoints"), token())
                  end
          end