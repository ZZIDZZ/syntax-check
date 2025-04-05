def update(data)
      data.each_byte do |b|
        b = revert_byte(b) if REVERSE_DATA
        @crc = ((@table[((@crc >> 8) ^ b) & 0xff] ^ (@crc << 8)) & 0xffff)
      end

      return self
    end