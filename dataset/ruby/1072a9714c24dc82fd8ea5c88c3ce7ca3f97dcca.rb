def subject_should_not_raise(*args)
      error, message = args
      it_string = "subject should not raise #{error}"
      it_string += " (#{message.inspect})" if message

      it it_string do
        expect { subject }.not_to raise_error error, message
      end
    end