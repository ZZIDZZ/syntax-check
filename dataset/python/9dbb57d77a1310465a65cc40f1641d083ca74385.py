def update_w(self):
        """ alternating least squares step, update W under the convexity
        constraint """
        def update_single_w(i):
            """ compute single W[:,i] """
            # optimize beta     using qp solver from cvxopt
            FB = base.matrix(np.float64(np.dot(-self.data.T, W_hat[:,i])))
            be = solvers.qp(HB, FB, INQa, INQb, EQa, EQb)
            self.beta[i,:] = np.array(be['x']).reshape((1, self._num_samples))

        # float64 required for cvxopt
        HB = base.matrix(np.float64(np.dot(self.data[:,:].T, self.data[:,:])))
        EQb = base.matrix(1.0, (1, 1))
        W_hat = np.dot(self.data, pinv(self.H))
        INQa = base.matrix(-np.eye(self._num_samples))
        INQb = base.matrix(0.0, (self._num_samples, 1))
        EQa = base.matrix(1.0, (1, self._num_samples))

        for i in range(self._num_bases):
            update_single_w(i)

        self.W = np.dot(self.beta, self.data.T).T