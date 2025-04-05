def data_system
      schema = self.folder/"schema.fio"
      if schema.file?
        Finitio::DEFAULT_SYSTEM.parse(schema.read)
      elsif not(self.parent.nil?)
        self.parent.data_system
      else
        Finitio::DEFAULT_SYSTEM
      end
    end