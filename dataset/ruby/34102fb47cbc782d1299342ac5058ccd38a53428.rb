def add(username, token)
      Firim::AccountManager.new(
        user: username,
        token: token
      ).add_to_keychain
    end