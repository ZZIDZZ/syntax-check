def loggabor_image(self, x_pos, y_pos, theta, sf_0, phase, B_sf, B_theta):
        """
        Returns the image of a LogGabor

        Note that the convention for coordinates follows that of matrices:
        the origin is at the top left of the image, and coordinates are first
        the rows (vertical axis, going down) then the columns (horizontal axis,
        going right).

        """

        FT_lg = self.loggabor(x_pos, y_pos, sf_0=sf_0, B_sf=B_sf, theta=theta, B_theta=B_theta)
        FT_lg = FT_lg * np.exp(1j * phase)
        return self.invert(FT_lg, full=False)