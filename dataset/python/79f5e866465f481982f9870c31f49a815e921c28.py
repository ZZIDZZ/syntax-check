def render(self, code):
        """Renders the barcode to whatever the inheriting writer provides,
        using the registered callbacks.

        :parameters:
            code : List
                List of strings matching the writer spec
                (only contain 0 or 1).
        """
        if self._callbacks['initialize'] is not None:
            self._callbacks['initialize'](code)
        ypos = 1.0
        for line in code:
            # Left quiet zone is x startposition
            xpos = self.quiet_zone
            for mod in line:
                if mod == '0':
                    color = self.background
                else:
                    color = self.foreground
                self._callbacks['paint_module'](xpos, ypos, self.module_width,
                                                color)
                xpos += self.module_width
            # Add right quiet zone to every line
            self._callbacks['paint_module'](xpos, ypos, self.quiet_zone,
                                            self.background)
            ypos += self.module_height
        if self.text and self._callbacks['paint_text'] is not None:
            ypos += self.text_distance
            if self.center_text:
                xpos = xpos / 2.0
            else:
                xpos = self.quiet_zone + 4.0
            self._callbacks['paint_text'](xpos, ypos)
        return self._callbacks['finish']()