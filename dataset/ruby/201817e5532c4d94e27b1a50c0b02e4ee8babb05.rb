def ssl_connect(socket, address, timeout)
      ssl_context = OpenSSL::SSL::SSLContext.new
      ssl_context.set_params(ssl.is_a?(Hash) ? ssl : {})

      ssl_socket            = OpenSSL::SSL::SSLSocket.new(socket, ssl_context)
      ssl_socket.hostname   = address.host_name
      ssl_socket.sync_close = true

      begin
        if timeout == -1
          # Timeout of -1 means wait forever for a connection
          ssl_socket.connect
        else
          deadline = Time.now.utc + timeout
          begin
            non_blocking(socket, deadline) { ssl_socket.connect_nonblock }
          rescue Errno::EISCONN
            # Connection was successful.
          rescue NonBlockingTimeout
            raise ConnectionTimeout.new("SSL handshake Timed out after #{timeout} seconds trying to connect to #{address.to_s}")
          end
        end
      rescue SystemCallError, OpenSSL::SSL::SSLError, IOError => exception
        message = "#connect SSL handshake failure with '#{address.to_s}': #{exception.class}: #{exception.message}"
        logger.error message if respond_to?(:logger)
        raise ConnectionFailure.new(message, address.to_s, exception)
      end

      # Verify Peer certificate
      ssl_verify(ssl_socket, address) if ssl_context.verify_mode != OpenSSL::SSL::VERIFY_NONE
      ssl_socket
    end