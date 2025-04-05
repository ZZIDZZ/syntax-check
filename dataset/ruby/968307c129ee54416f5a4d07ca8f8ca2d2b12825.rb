def contains_revision?(rev)
      cmd = git("cat-file -t #{rev}")
      cmd.stdout.strip == "commit"
    rescue CommandFailed
      log.debug(log_key) { "unable to determine presence of commit #{rev}" }
      false
    end