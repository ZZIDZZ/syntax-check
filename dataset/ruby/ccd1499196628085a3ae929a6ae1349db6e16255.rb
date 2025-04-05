def padout(message)
      message_length = self.class.display_columns(message)

      if @last_render_width > message_length
        remaining_width = @last_render_width - message_length
        message += ' ' * remaining_width
      end
      message
    end