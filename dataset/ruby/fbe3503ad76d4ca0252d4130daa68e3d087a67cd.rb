def all
      list = []
      page = 1
      fetch_all = true

      if @query.has_key?(:page)
        page = @query[:page]
        fetch_all = false
      end
      
      while true
        response = RestClient.get(@type.Resource, @query)
        data = response.body[@type.Resource]      
        if !data.empty?
          data.each {|item| list << @type.new.from_json(item.to_json)}
          
          if !fetch_all
            break
          else
            where(page: page += 1)
          end
        else
          break
        end
      end

      return list
    end