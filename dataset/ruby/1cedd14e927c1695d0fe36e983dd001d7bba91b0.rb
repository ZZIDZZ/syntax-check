def mail_form_attributes
      self.class.mail_attributes.each_with_object({}) do |attr, hash|
        hash[attr.to_s] = send(attr)
      end
    end