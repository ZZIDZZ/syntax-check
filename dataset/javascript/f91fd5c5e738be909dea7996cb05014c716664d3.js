function performCycle() {
    _currentTime += 1;

    let selectedAndExecutedActions = new LiteralTreeMap();
    let executedObservations = new LiteralTreeMap();

    // Step 0 - Updating database
    let updatedState = _program.getState().clone();
    updateStateWithFluentActors(
      this,
      _program.getExecutedActions(),
      updatedState
    );
    _program.setState(updatedState);

    _nextCycleObservations.forEach((obs) => {
      executedObservations.add(obs);
    });
    _nextCycleActions.forEach((act) => {
      selectedAndExecutedActions.add(act);
    });

    // Step 1 - Processing rules
    let newFiredGoals = processRules(this, _program, _currentTime, _profiler);
    _goals = _goals.concat(newFiredGoals);

    // Step 3 - Processing
    return evaluateGoalTrees(_currentTime, _goals, _profiler)
      .then((newGoals) => {
        _goals = newGoals;

        // Start preparation for next cycle

        // reset the set of executed actions
        _program.setExecutedActions(new LiteralTreeMap());
        _goals.sort(goalTreeSorter(_currentTime));

        // select actions from candidate actions
        return actionsSelector.call(this, _goals);
      })
      .then((nextCycleActions) => {
        _nextCycleActions = new LiteralTreeMap();
        nextCycleActions.forEach((l) => {
          _nextCycleActions.add(l);
        });
        _nextCycleObservations = new LiteralTreeMap();
        let cycleObservations = processCycleObservations.call(this);
        cycleObservations.forEach((observation) => {
          nextCycleActions.add(observation);
          _nextCycleObservations.add(observation);
        });

        _program.setExecutedActions(nextCycleActions);

        _lastCycleActions = selectedAndExecutedActions;
        _lastCycleObservations = executedObservations;

        // done with cycle
        return Promise.resolve();
      });
  }