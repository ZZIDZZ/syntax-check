def update_xml(xml, value)
      wrap(xml).tap do |xml|
        if content?
          add(xml, value)
        elsif name?
          xml.name = value
        elsif array?
          value.each do |v|
            add(XML.add_node(xml, name), v)
          end
        else
          add(XML.add_node(xml, name), value)
        end
      end
    end