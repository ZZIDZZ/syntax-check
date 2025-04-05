def email_addresses(text)
      text.gsub(@regex[:mail]) do
        text = $&
        if auto_linked?($`, $')
          text
        else
          display_text = (block_given?) ? yield(text) : text
          # mail_to text, display_text
          "<a href='mailto:#{text}'>#{display_text}</a>"
        end
      end
    end