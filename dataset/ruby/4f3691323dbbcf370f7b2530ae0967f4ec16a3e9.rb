def build_sentence_from_hash(nodes)
      result = []
      nodes.each do |node|
        # This node does not appear in params
        if node[:current_value].nil?
          if node[:always_use]
            result << node[:sentence]
          end
        else
          result << node[:sentence]
        end
      end
      result
    end