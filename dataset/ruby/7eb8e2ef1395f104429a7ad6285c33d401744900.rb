def p_secret_to_public(secret)
      expanded = secret_expand(secret)
      a = expanded.first
      return point_compress(point_mul(a, @@G))
    end