def action_link(action, prefix)
      html_class = "actions #{action.to_s}_link"
      block = lambda do |resource|
        compound_resource = [prefix, resource].compact
        compound_resource.flatten! if prefix.kind_of?(Array)
        case action
        when :show
          @template.link_to(link_title(action), compound_resource)
        when :destroy
          @template.link_to(link_title(action), compound_resource,
                            :method => :delete, :data => { :confirm => confirmation_message })
        else # edit, other resource GET actions
          @template.link_to(link_title(action),
                            @template.polymorphic_path(compound_resource, :action => action))
        end
      end
      self.cell(action, :heading => "", :cell_html => {:class => html_class}, &block)
    end