def indirect_conditions(object)
      t = arel_table
      node = to_node(object)
      # rails has case sensitive matching.
      if ActiveRecord::VERSION::MAJOR >= 5
        t[ancestry_column].matches("#{node.child_ancestry}/%", nil, true)
      else
        t[ancestry_column].matches("#{node.child_ancestry}/%")
      end
    end