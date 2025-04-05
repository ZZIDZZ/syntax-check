def generate_unique(length = 32, &blk)
      unique = generate_random(length)
      unique = generate_random(length) until blk.call(unique)
      unique
    end