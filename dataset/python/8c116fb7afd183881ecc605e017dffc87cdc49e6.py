def fast_forward_selection(scenarios, number_of_reduced_scenarios, probability=None):
    """Fast forward selection algorithm

    Parameters
    ----------
    scenarios : numpy.array
        Contain the input scenarios.
        The columns representing the individual scenarios
        The rows are the vector of values in each scenario
    number_of_reduced_scenarios : int
        final number of scenarios that
        the reduced scenarios contain.
        If number of scenarios is equal to or greater than the input scenarios,
        then the original input scenario set is returned as the reduced set
    probability : numpy.array (default=None)
        probability is a numpy.array with length equal to number of scenarios.
        if probability is not defined, all scenarios get equal probabilities

    Returns
    -------
    reduced_scenarios : numpy.array
        reduced set of scenarios
    reduced_probability : numpy.array
        probability of reduced set of scenarios
    reduced_scenario_set : list
        scenario numbers of reduced set of scenarios

    Example
    -------
    Scenario reduction can be performed as shown below::

        >>> import numpy as np
        >>> import random
        >>> scenarios = np.array([[random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)],
        >>>         [random.randint(500,1000) for i in range(0,24)]])
        >>> import psst.scenario
        >>> reduced_scenarios, reduced_probability, reduced_scenario_numbers = psst.scenario.fast_forward_selection(scenarios, probability, 2)
    """
    print("Running fast forward selection algorithm")

    number_of_scenarios = scenarios.shape[1]
    logger.debug("Input number of scenarios = %d", number_of_scenarios)

    # if probability is not defined assign equal probability to all scenarios
    if probability is None:
        probability = np.array([1/number_of_scenarios for i in range(0, number_of_scenarios)])

    # initialize z, c and J
    z = np.array([np.inf for i in range(0, number_of_scenarios)])
    c = np.zeros((number_of_scenarios, number_of_scenarios))
    J = range(0, number_of_scenarios)

    # no reduction necessary
    if number_of_reduced_scenarios >= number_of_scenarios:
        return(scenarios, probability, J)

    for scenario_k in range(0, number_of_scenarios):
        for scenario_u in range(0, number_of_scenarios):
            c[scenario_k, scenario_u] = distance(scenarios[:, scenario_k], scenarios[:, scenario_u])

    for scenario_u in range(0, number_of_scenarios):
        summation = 0
        for scenario_k in range(0, number_of_scenarios):
            if scenario_k != scenario_u:
                summation = summation + probability[scenario_k]*c[scenario_k, scenario_u]

        z[scenario_u] = summation

    U = [np.argmin(z)]

    for u in U:
        J.remove(u)

    for _ in range(0, number_of_scenarios - number_of_reduced_scenarios - 1):
        print("Running {}".format(_))

        for scenario_u in J:
            for scenario_k in J:
                lowest_value = np.inf

                for scenario_number in U:
                    lowest_value = min(c[scenario_k, scenario_u], c[scenario_k, scenario_number])

            c[scenario_k, scenario_u] = lowest_value

        for scenario_u in J:
            summation = 0
            for scenario_k in J:
                if scenario_k not in U:
                    summation = summation + probability[scenario_k]*c[scenario_k, scenario_u]

            z[scenario_u] = summation

        u_i = np.argmin([item if i in J else np.inf for i, item in enumerate(z)])

        J.remove(u_i)
        U.append(u_i)

    reduced_scenario_set = U
    reduced_probability = []

    reduced_probability = copy.deepcopy(probability)
    for deleted_scenario_number in J:
        lowest_value = np.inf

        # find closest scenario_number
        for scenario_j in reduced_scenario_set:
            if c[deleted_scenario_number, scenario_j] < lowest_value:
                closest_scenario_number = scenario_j
                lowest_value = c[deleted_scenario_number, scenario_j]

        reduced_probability[closest_scenario_number] = reduced_probability[closest_scenario_number] + reduced_probability[deleted_scenario_number]

    reduced_scenarios = copy.deepcopy(scenarios[:, reduced_scenario_set])
    reduced_probability = reduced_probability[reduced_scenario_set]



    return reduced_scenarios, reduced_probability, reduced_scenario_set