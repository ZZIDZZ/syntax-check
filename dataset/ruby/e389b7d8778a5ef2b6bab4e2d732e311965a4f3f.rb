def audit_responses
      form.response_fields.each do |response_field|
        response_field.audit_response(self.response_value(response_field), get_responses)
      end

      mark_responses_as_changed!
    end