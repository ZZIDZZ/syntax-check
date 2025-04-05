def update(options={}, &block)
      apply_options(options, &block)
      if @notification
        notify_notification_update(@notification, summary, body, icon_path, nil)
        show
      else
        show!
      end
    end