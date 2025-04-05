def rate_time
      regexp = Regexp.new(currency_code)
      page.search("//span[@name='pair']").each do |td|
        if regexp.match(td.content)
          hour = td.next_element.next_element.content
          return DateTime.parse(hour)
        end
      end
    end