def pack_entities(entities)
      entities.each do |entity|
        # ignore bad entities
        next unless entity.is_a?(Hash) && entity[:path]

        path = entity[:path]
        if File.symlink? path
          postpone_symlink entity
        elsif File.directory? path
          postpone_dir entity
        elsif File.file? path
          pack_file_entity entity
        end
      end
    end