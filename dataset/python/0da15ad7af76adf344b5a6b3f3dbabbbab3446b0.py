def theta(self, s):

        '''
        Theta sigmoid function
        '''

        s = np.where(s < -709, -709, s)

        return 1 / (1 + np.exp((-1) * s))