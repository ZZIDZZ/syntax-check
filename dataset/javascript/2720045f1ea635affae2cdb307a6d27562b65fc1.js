function replace(reducers, scope, defaultState) {
  remove(scope);
  add(reducers, scope, defaultState);
}