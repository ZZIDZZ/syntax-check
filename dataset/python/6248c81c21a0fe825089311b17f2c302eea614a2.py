def _cubic_bernstein(p0, p1, p2, p3, t):
        """
        Evaluate polynomial of given bernstein coefficients
        using de Casteljau's algorithm.
        """
        u = 1 - t
        return p0*(u**3) + 3*t*u*(p1*u + p2*t) + p3*(t**3)