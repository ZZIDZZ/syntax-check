def write_file(remote_file, data)
      raise ConnectionClosed.new('Connection is closed.') unless @ssh
      sftp.file.open(remote_file, 'w') do |f|
        f.write data
      end
    end