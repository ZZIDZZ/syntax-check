function explode(store, data) {
  if (isPlainObject(data)) {
    const obj = {};

    for (const prop in data) {
      obj[prop] = explode(store, data[prop]);
    }
    return obj;
  } else if (Array.isArray(data)) {
    return data.map(value => explode(store, value));
  } else if (store._isRefValue(data)) {
    return explode(store, store.get(store._parseRefKey(data)));
  }

  return data;
}