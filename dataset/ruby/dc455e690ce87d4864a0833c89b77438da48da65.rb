def transmit_packet(packet, options={})
      # Default options
      options = {
        cache: false
      }.merge(options)

      packet = packet.as_json.deep_symbolize_keys

      if validate_packet(packet, options)
        if options[:cache]==true
          if update_cache(packet)
            transmit packet
          end
        else
          transmit packet
        end
      end
    end