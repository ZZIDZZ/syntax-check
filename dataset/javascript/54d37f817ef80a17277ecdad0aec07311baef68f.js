function handleErrors(errors, data) {
  const message = errors[0].message;
  const error = new Error(`GraphQL Error: ${message}`);
  error.rawError = errors;
  error.rawData = data;
  throw error;
}