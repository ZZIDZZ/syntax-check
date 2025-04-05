function configureStore(onComplete) {
  // Apply middlewares
  var middlewares = [thunk];
  events.emit('middlewaresWillApply', middlewares);
  if (__DEV__ && !!window.navigator.userAgent) {
    middlewares.push(createLogger({
      collapsed: true,
      duration: true,
    }));
  }

  // Create store
  var storeCreator = applyMiddleware.apply(null, middlewares)(createStore);
  var result = {}; // {store: <created store>}
  events.emit('storeWillCreate', storeCreator, reducers, onComplete, result);

  if (result.store === undefined) {
    result.store = storeCreator(reducers);
    setTimeout(onComplete, 0);
  }

  global.reduxStore = result.store;
  return reduxStore;
}