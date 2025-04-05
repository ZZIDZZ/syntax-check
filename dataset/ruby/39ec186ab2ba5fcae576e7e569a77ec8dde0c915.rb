def get_random_number_with_bitlength(bits)
      byte_length = (bits / 8.0).ceil + 10
      random_num = get_random_number(byte_length)
      random_num_bin_str = random_num.to_s(2) # Get 1's and 0's

      # Slice off only the bits we require, convert Bits to Numeric (Bignum)
      random_num_bin_str.slice(0, bits).to_i(2)
    end