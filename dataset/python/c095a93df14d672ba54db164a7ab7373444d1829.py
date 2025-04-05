def parallel(collection, method, processes=None, args=None, **kwargs):
    '''Processes a collection in parallel.

    Parameters
    ----------
    collection : list
        i.e. list of Record objects
    method : method to call on each Record
    processes : int
        number of processes to run on [defaults to number of cores on machine]
    batch_size : int
        lenght of each batch [defaults to number of elements / number of processes]

    Returns
    -------
    collection : list
        list of Record objects after going through method called

    Example
    -------
    adding 2 to every number in a range

    >>> import turntable
    >>> collection = range(100)
    >>> def jam(record):
    >>>     return record + 2
    >>> collection = turntable.spin.parallel(collection, jam)

    Note
    ----

    lambda functions do not work in parallel

    '''


    if processes is None:
        # default to the number of cores, not exceeding 20
        processes = min(mp.cpu_count(), 20)
    print "Running parallel process on " + str(processes) + " cores. :-)"

    pool = mp.Pool(processes=processes)
    PROC = []
    tic = time.time()
    for main_arg in collection:
        if args is None:
            ARGS = (main_arg,)
        else:
            if isinstance(args, tuple) == False:
                args = (args,)
            ARGS = (main_arg,) + args
        PROC.append(pool.apply_async(method, args=ARGS, kwds=kwargs))
    #RES = [p.get() for p in PROC]
    RES = []
    for p in PROC:
        try:
            RES.append(p.get())
        except Exception as e:
            print "shit happens..."
            print e
            RES.append(None)
    pool.close()
    pool.join()

    toc = time.time()
    elapsed = toc - tic
    print "Elapsed time: %s  on %s processes :-)\n" % (str(elapsed), str(processes))

    return RES