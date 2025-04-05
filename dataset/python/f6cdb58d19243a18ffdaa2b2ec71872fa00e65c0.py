def from_regression(cls, clock_model):
        """
        Create the conversion object automatically from the tree

        Parameters
        ----------

         clock_model : dict
            dictionary as returned from TreeRegression with fields intercept and slope

        """
        dc = cls()
        dc.clock_rate = clock_model['slope']
        dc.intercept = clock_model['intercept']
        dc.chisq = clock_model['chisq'] if 'chisq' in clock_model else None
        dc.valid_confidence = clock_model['valid_confidence'] if 'valid_confidence' in clock_model else False
        if 'cov' in clock_model and dc.valid_confidence:
            dc.cov = clock_model['cov']
        dc.r_val = clock_model['r_val']
        return dc