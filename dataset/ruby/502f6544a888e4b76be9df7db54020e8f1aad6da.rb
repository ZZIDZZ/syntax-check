def interpolate(replacement, match)
      group_idx = replacement.index('$')
      return replacement if group_idx.nil?

      group_nbr = replacement[group_idx + 1]
      replacement.sub("$#{group_nbr}", match[group_nbr.to_i])
    end