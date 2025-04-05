def event_summary(trim_at = 100)
      summary = @event['check']['notification'] || @event['check']['description']
      if summary.nil?
        source = @event['check']['source'] || @event['client']['name']
        event_context = [source, @event['check']['name']].join('/')
        output = @event['check']['output'].chomp
        output = output.length > trim_at ? output[0..trim_at] + '...' : output
        summary = [event_context, output].join(' : ')
      end
      summary
    end