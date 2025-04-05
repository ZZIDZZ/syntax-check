def graphic_target(self, x, y):
        """
        The following update labels about mouse coordinates.
        """

        if self.authorized_display == True:
            try:
                self.display_the_graphic(self.num_line, self.wavelength, self.data_wanted, self.information)
                self.ui.mouse_coordinate.setText("(%0.3f, %0.3f)" % (x, y))
            except:
                pass