def compute(self, tdb, tdb2, derivative=True):
        """Generate angles and derivatives for time `tdb` plus `tdb2`.

        If ``derivative`` is true, return a tuple containing both the
        angle and its derivative; otherwise simply return the angles.

        """
        scalar = not getattr(tdb, 'shape', 0) and not getattr(tdb2, 'shape', 0)
        if scalar:
            tdb = array((tdb,))

        data = self._data
        if data is None:
            self._data = data = self._load()

        initial_epoch, interval_length, coefficients = data
        component_count, n, coefficient_count = coefficients.shape

        # Subtracting tdb before adding tdb2 affords greater precision.
        index, offset = divmod((tdb - initial_epoch) + tdb2, interval_length)
        index = index.astype(int)

        if (index < 0).any() or (index > n).any():
            final_epoch = initial_epoch + interval_length * n
            raise ValueError('segment only covers dates %.1f through %.1f'
                            % (initial_epoch, final_epoch))

        omegas = (index == n)
        index[omegas] -= 1
        offset[omegas] += interval_length

        coefficients = coefficients[:,index]

        # Chebyshev polynomial.

        T = empty((coefficient_count, len(index)))
        T[0] = 1.0
        T[1] = t1 = 2.0 * offset / interval_length - 1.0
        twot1 = t1 + t1
        for i in range(2, coefficient_count):
            T[i] = twot1 * T[i-1] - T[i-2]

        components = (T.T * coefficients).sum(axis=2)
        if scalar:
            components = components[:,0]

        if not derivative:
            return components

        # Chebyshev differentiation.

        dT = empty_like(T)
        dT[0] = 0.0
        dT[1] = 1.0
        if coefficient_count > 2:
            dT[2] = twot1 + twot1
            for i in range(3, coefficient_count):
                dT[i] = twot1 * dT[i-1] - dT[i-2] + T[i-1] + T[i-1]
        dT *= 2.0
        dT /= interval_length

        rates = (dT.T * coefficients).sum(axis=2)
        if scalar:
            rates = rates[:,0]

        return components, rates