def label(method, text = nil, options = {})
      colon = false if options[:colon].nil?
      options[:for] = options[:label_for]
      required = options[:required]

      # remove special options
      options.delete :colon
      options.delete :label_for
      options.delete :required

      text = @template.send(:h, text.blank?? method.to_s.humanize : text.to_s)
      text << ':'.html_safe if colon
      text << @template.content_tag(:span, "*", :class => "required") if required
      super
    end