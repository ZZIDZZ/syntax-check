def run
      while @jobs.length > 0 do
        # do a warm up run first with the highest connection rate
        @current_job = @jobs.pop
        @current_rate = @current_job.high_rate.to_i
        httperf true

        (@current_job.low_rate.to_i..@current_job.high_rate.to_i).
            step(@current_job.rate_step.to_i) do |rate|
          @current_rate = rate
          httperf
        end
        output
      end
    end