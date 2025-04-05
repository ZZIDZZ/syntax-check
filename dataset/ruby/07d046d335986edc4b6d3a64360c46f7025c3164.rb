def build_signature_buffer(result)
      response = Net::SSH::Buffer.new
      response.write_string data[:client_version_string],
                            data[:server_version_string],
                            data[:client_algorithm_packet],
                            data[:server_algorithm_packet],
                            result[:key_blob]
      response.write_long MINIMUM_BITS,
                          data[:need_bits],
                          MAXIMUM_BITS
      response.write_bignum dh.p, dh.g, dh.pub_key,
                            result[:server_dh_pubkey],
                            result[:shared_secret]
      response
    end