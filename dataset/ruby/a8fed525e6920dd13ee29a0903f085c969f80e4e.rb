def topology
      self.discover unless @first_device_ip
      return [] unless @first_device_ip

      doc = Nokogiri::XML(open("http://#{@first_device_ip}:#{Sonos::PORT}/status/topology"))
      doc.xpath('//ZonePlayers/ZonePlayer').map do |node|
        TopologyNode.new(node)
      end
    end