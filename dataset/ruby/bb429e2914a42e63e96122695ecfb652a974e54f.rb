def render
      if self.has_content?
        self.to_a.inject(''){|loop_str, i|
          loop_str += i.nodes.inject(''){|nodes_str, j|
            nodes_str += j.render
          } 
        }
      else
        ''
      end
    end