def before_destroy_rebuild_node_map

				self.survey.node_maps.select { |i|
					i.node == self
				}.each { |node_map|
					# Remap all of this nodes children to the parent
					node_map.children.each  { |child|
						if !child.node.class.ancestors.include?(::ActiveRecordSurvey::Node::Answer)
							node_map.parent.children << child
						end
					}
				}

				true
			end