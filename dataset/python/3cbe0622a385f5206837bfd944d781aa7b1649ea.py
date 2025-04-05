def make_fake_movie(nframes, mask_shape=(64, 64), mask_center=None,
                    bg_intensity=0.1, mask_sigma=10, dt=0.02, rate=1.0,
                    tau=1., sigma=0.001, seed=None):
    """
    Generate 2D fake fluorescence movie

    Arguments:
    ---------------------------------------------------------------------------
        nframes:        number of timebins to simulate
        mask_shape:     tuple (nrows, ncols), shape of a single movie frame
        mask_center:    tuple (x, y), pixel coords of cell center
        bg_intensity:   scalar, amplitude of (static) baseline fluorescence
        mask_sigma:     scalar, standard deviation of Gaussian mask
        dt:             timestep (s)
        rate:           mean spike rate (Hz)
        tau:            time constant of decay in calcium concentration (s)
        sigma:          SD of additive noise on fluorescence
        seed:           Seed for RNG

    Returns:
    ---------------------------------------------------------------------------
        F:          fluorescence [npixels, nframes]
        c:          calcium concentration [nframes,]
        n:          spike train [nframes,]
        theta:      tuple of true model parameters:
                    (sigma, alpha, beta, lambda, gamma)

    """

    gen = np.random.RandomState(seed)

    # poisson spikes
    n = gen.poisson(rate * dt, size=nframes)

    # internal calcium dynamics
    gamma = np.exp(-dt / tau)
    c = signal.lfilter(np.r_[1], np.r_[1, -gamma], n, axis=0)

    # pixel weights (sum == 1)
    nr, nc = mask_shape
    npix = nr * nc
    if mask_center is None:
        mask_center = (nc // 2., nr // 2.)
    a, b = mask_center
    y, x = np.ogrid[:nr, :nc]
    xs = (x - a) ** 2.
    ys = (y - b) ** 2.
    twoss = 2. * mask_sigma ** 2.
    alpha = np.exp(-1 * ((xs / twoss) + (ys / twoss))).ravel()
    alpha /= alpha.sum()

    # background fluorescence
    beta = gen.randn(npix) * bg_intensity

    # firing rate (spike probability per sec)
    lamb = rate

    # spatially & temporally white noise
    epsilon = gen.randn(npix, nframes) * sigma

    # simulated fluorescence
    F = c[None, :] * alpha[:, None] + beta[:, None] + epsilon

    theta = (sigma, alpha, beta, lamb, gamma)

    return F, c, n, theta