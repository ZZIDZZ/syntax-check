def write_pid(pid)
      ::File.open(pid, 'w') { |f| f.write("#{Process.pid}") }
      at_exit { ::File.delete(pid) if ::File.exist?(pid) rescue nil }
    end