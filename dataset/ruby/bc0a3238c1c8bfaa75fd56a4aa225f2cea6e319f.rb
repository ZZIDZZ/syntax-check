def link content = nil, options = nil, html_options = nil, &block
      @actions << UiBibz::Ui::Core::Forms::Dropdowns::Components::DropdownLink.new(content, options, html_options, &block).render
    end