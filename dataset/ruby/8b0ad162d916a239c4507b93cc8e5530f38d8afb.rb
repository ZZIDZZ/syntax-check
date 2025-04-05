def execute
      raise errors.to_sentences unless valid?

      # default failing command
      result = false

      # protect command from recursion
      mutex = Mutagem::Mutex.new('revenc.lck')
      lock_successful = mutex.execute do
        result = system_cmd(cmd)
      end

      raise "action failed, lock file present" unless lock_successful
      result
    end