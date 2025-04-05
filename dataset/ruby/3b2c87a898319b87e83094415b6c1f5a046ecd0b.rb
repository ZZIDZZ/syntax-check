def next_message
      read_header         if @state == :header
      read_payload_length if @state == :payload_length
      read_mask_key       if @state == :mask
      read_payload        if @state == :payload

      @state == :complete ? process_frame! : nil

    rescue StandardError => ex
      if @on_error
        @on_error.call(ex.message)
      else
        raise ex
      end
    end