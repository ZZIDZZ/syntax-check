def error
      {
        error: { 
          model: self.object["model"],
          model_human: self.object["model_human"],
          attribute: self.object["attribute"],
          attribute_human: self.object["attribute_human"],
          field: self.object["field"],
          message: self.object["message"],
          full_message: "#{self.object["full_message"]}"
        } 
      }
    end