def node(name)
      name = name.to_sym
      @nodes.detect{|node|
        node.name == name
      }
    end