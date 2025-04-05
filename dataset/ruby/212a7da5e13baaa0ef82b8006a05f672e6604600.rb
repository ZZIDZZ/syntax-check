def div
      cr_scanner = CodeRay.scan(self.clip, self.language)
      # Only show line numbers if its greater than 1
      if cr_scanner.loc <= 1
        return cr_scanner.div
      else
        return cr_scanner.div(:line_numbers => :table)
      end
    end