def gotcha(options = {})
      options[:label_options] ||= {}
      options[:text_field_options] ||= {}
      if gotcha = Gotcha.random
        field = "gotcha_response[#{gotcha.class.name.to_s}-#{Digest::MD5.hexdigest(gotcha.class.down_transform(gotcha.answer))}]"
        (label_tag field, gotcha.question, options[:label_options]) + "\n" + (text_field_tag field, nil, options[:text_field_options])
      else
        raise "No Gotchas Installed"
      end
    end