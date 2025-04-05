def autocomplete_to_add_item(name, f, association, source, options = {})
      new_object              = f.object.send(association).klass.new
      options[:class]         = ["autocomplete add-item", options[:class]].compact.join " "
      options[:data]          ||= {}
      options[:data][:id]     = new_object.object_id
      options[:data][:source] = source
      options[:data][:item]   = f.fields_for(association, new_object, child_index: options[:data][:id]) do |builder|
        render(association.to_s.singularize + "_item", f: builder).gsub "\n", ""
      end
      
      text_field_tag "autocomplete_nested_content", nil, options
    end