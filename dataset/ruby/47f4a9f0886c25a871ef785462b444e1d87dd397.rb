def transfer(to:, private_key:, value:, quota: 30_000)
      valid_until_block = block_number["result"].hex + 88
      meta_data = get_meta_data("latest")["result"]
      version = meta_data["version"]
      chain_id = if version.zero?
                   meta_data["chainId"]
                 elsif version == 1
                   meta_data["chainIdV1"]
                 end
      transaction = Transaction.new(nonce: Utils.nonce, valid_until_block: valid_until_block, chain_id: chain_id, to: to, value: value, quota: quota, version: version)
      send_transaction(transaction, private_key)
    end