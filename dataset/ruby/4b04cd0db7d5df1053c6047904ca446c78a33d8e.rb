def open(enciphered_message)
      nonce, ciphertext = extract_nonce(enciphered_message.to_s)
      @box.open(nonce, ciphertext)
    end