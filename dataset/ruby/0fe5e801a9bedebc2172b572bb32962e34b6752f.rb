def parse_user_info(node)
      return nil if node.nil?
      {}.tap do |hash|
        node.children.each do |e|
          unless e.kind_of?(Nokogiri::XML::Text) || e.name == 'proxies'
            # There are no child elements
            if e.element_children.count == 0
              if hash.has_key?(e.name)
                hash[e.name] = [hash[e.name]] if hash[e.name].is_a? String
                hash[e.name] << e.content
              else
                hash[e.name] = e.content
              end
            elsif e.element_children.count
              # JASIG style extra attributes
              if e.name == 'attributes'
                hash.merge!(parse_user_info(e))
              else
                hash[e.name] = [] if hash[e.name].nil?
                hash[e.name] = [hash[e.name]] if hash[e.name].is_a? String
                hash[e.name].push(parse_user_info(e))
              end
            end
          end
        end
      end
    end