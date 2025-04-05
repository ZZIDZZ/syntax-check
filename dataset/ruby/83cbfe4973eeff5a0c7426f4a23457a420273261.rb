def get_modlog subreddit, opts = {}
      logged_in?
      options = {
        limit: 100
      }.merge opts
      data = Nokogiri::HTML.parse(get("/r/#{subreddit}/about/log", query: options).body).css('.modactionlisting tr')
      processed = {
        data:       [],
        first:      data[0]['data-fullname'],
        first_date: Time.parse(data[0].children[0].child['datetime']),
        last:       data[-1]['data-fullname'],
        last_date:  Time.parse(data[-1].children[0].child['datetime']),
      }
      data.each do |tr|
        processed[:data] << {
          fullname:     tr['data-fullname'],
          time:         Time.parse(tr.children[0].child['datetime']),
          author:       tr.children[1].child.content,
          action:       tr.children[2].child['class'].split[1],
          description:  tr.children[3].content,
          href:         tr.children[3].css('a').count == 0 ? nil : tr.children[3].css('a')[0]['href']
        }
      end
      return processed
    end