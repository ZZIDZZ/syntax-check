def eager(command)
      require 'pty'

      begin
        PTY.spawn command do |r, w, pid|
          begin
            $stdout.puts
            r.each {|line| print line }
          rescue Errno::EIO
            # the process has finished
          end
        end
      rescue PTY::ChildExited
        $stdout.puts "The child process exited!"
      end
    end