def set_basepath
      if self.parent.nil?
        self.basepath = self.basename
        self.basedirpath ||= ''
      else
        self.basepath = self.parent.basepath+'/'+self.basename
        self.basedirpath ||= self.parent.basepath+'/'
      end

    end