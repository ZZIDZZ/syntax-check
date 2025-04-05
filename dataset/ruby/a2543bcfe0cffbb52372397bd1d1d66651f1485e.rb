def dir(path)
      owconnect do |socket|
        owwrite(socket,:path => path, :function => DIR)
        
        fields = []
        while true
          response = owread(socket)
          if response.data
            fields << response.data
          else
            break
          end
        end
        return fields
      end
    end