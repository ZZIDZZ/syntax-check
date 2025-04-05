function closeAllInstances(registry = _registry) {
  const promises = [];
  const errors = [];
  while (registry.length > 0) {
    const knex = registry.pop();
    const destructionPromise = knex.destroy().catch(e => {
      errors.push({
        knex,
        cause: e
      });
    });
    promises.push(destructionPromise);
  }
  return Promise.all(promises).then(() => {
    return errors;
  });
}