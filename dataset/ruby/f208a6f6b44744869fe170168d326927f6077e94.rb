def substitution_value(index)
      sha = Digest::SHA1.digest(index.to_s)
      Base64.urlsafe_encode64(sha).gsub(/[^A-Za-z]/, '')[0..5]
    end