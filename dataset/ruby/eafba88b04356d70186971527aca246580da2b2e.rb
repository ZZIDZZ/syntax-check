def strict_ancestor_of?(block_start)
      block_start && block_start.parent && (self == block_start.parent || strict_ancestor_of?(block_start.parent))
    end