def coalesce_execution_steps(execution_plan):
    '''Groups execution steps by solid, in topological order of the solids.'''

    solid_order = _coalesce_solid_order(execution_plan)

    steps = defaultdict(list)

    for solid_name, solid_steps in itertools.groupby(
        execution_plan.topological_steps(), lambda x: x.solid_name
    ):
        steps[solid_name] += list(solid_steps)

    return OrderedDict([(solid_name, steps[solid_name]) for solid_name in solid_order])