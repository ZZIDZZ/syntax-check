def lognormal(self,doprint=True):
        """
        Use the maximum likelihood estimator for a lognormal distribution to
        produce the best-fit lognormal parameters
        """
        # N = float(self.data.shape[0])
        # mu = log(self.data).sum() / N
        # sigmasquared = ( ( log(self.data) - mu )**2 ).sum() / N
        # self.lognormal_mu = mu
        # self.lognormal_sigma = np.sqrt(sigmasquared)
        # self.lognormal_likelihood = -N/2. * log(np.pi*2) - N/2. * log(sigmasquared) - 1/(2*sigmasquared) * (( self.data - mu )**2).sum()
        # if doprint:
        #     print "Best fit lognormal is exp( -(x-%g)^2 / (2*%g^2)" % (mu,np.sqrt(sigmasquared))
        #     print "Likelihood: %g" % (self.lognormal_likelihood)
        if scipyOK:
            fitpars = scipy.stats.lognorm.fit(self.data)
            self.lognormal_dist = scipy.stats.lognorm(*fitpars)
            self.lognormal_ksD,self.lognormal_ksP = scipy.stats.kstest(self.data,self.lognormal_dist.cdf)
            # nnlf = NEGATIVE log likelihood
            self.lognormal_likelihood = -1*scipy.stats.lognorm.nnlf(fitpars,self.data)

            # Is this the right likelihood ratio?
            # Definition of L from eqn. B3 of Clauset et al 2009:
            # L = log(p(x|alpha))
            # _nnlf from scipy.stats.distributions:
            # -sum(log(self._pdf(x, *args)),axis=0)
            # Assuming the pdf and p(x|alpha) are both non-inverted, it looks
            # like the _nnlf and L have opposite signs, which would explain the
            # likelihood ratio I've used here:
            self.power_lognorm_likelihood = (self._likelihood + self.lognormal_likelihood)
            # a previous version had 2*(above).  That is the correct form if you want the likelihood ratio
            # statistic "D": http://en.wikipedia.org/wiki/Likelihood-ratio_test
            # The above explanation makes sense, since nnlf is the *negative* log likelihood function:
            ## nnlf  -- negative log likelihood function (to minimize)
            #
            # Assuming we want the ratio between the POSITIVE likelihoods, the D statistic is:
            # D = -2 log( L_power / L_lognormal )
            self.likelihood_ratio_D = -2 * (log(self._likelihood/self.lognormal_likelihood))

            if doprint:
                print("Lognormal KS D: %g  p(D): %g" % (self.lognormal_ksD,self.lognormal_ksP), end=' ')
                print("  Likelihood Ratio Statistic (powerlaw/lognormal): %g" % self.likelihood_ratio_D)
                print("At this point, have a look at Clauset et al 2009 Appendix C: determining sigma(likelihood_ratio)")