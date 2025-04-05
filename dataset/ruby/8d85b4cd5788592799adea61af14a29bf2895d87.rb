def _squash_changes(changes)
      # We combine here for backward compatibility
      # Newer clients should receive dir and path separately
      changes = changes.map { |change, dir, path| [change, dir + path] }

      actions = changes.group_by(&:last).map do |path, action_list|
        [_logical_action_for(path, action_list.map(&:first)), path.to_s]
      end

      config.debug("listen: raw changes: #{actions.inspect}")

      { modified: [], added: [], removed: [] }.tap do |squashed|
        actions.each do |type, path|
          squashed[type] << path unless type.nil?
        end
        config.debug("listen: final changes: #{squashed.inspect}")
      end
    end