def _cauchy_equation(wavelength, coefficients):
        '''
        Helpful function to evaluate Cauchy equations.

        Args:
            wavelength (float, list, None): The wavelength(s) the
                Cauchy equation will be evaluated at.
            coefficients (list): A list of the coefficients of
                the Cauchy equation.

        Returns:
            float, list: The refractive index at the target wavelength(s).
        '''
        n = 0.
        for i, c in enumerate(coefficients):
            exponent  = 2*i
            n += c / wavelength**exponent
        return n