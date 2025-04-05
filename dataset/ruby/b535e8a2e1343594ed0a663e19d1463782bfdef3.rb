def exit_code
      fail_chance   = ENV.fetch('REX_SIMULATE_FAIL_CHANCE', 0).to_i
      fail_exitcode = ENV.fetch('REX_SIMULATE_EXIT', 0).to_i
      if fail_exitcode == 0 || fail_chance < (Random.rand * 100).round
        0
      else
        fail_exitcode
      end
    end