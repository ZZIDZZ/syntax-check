function formatInputs(method, inputs) {
  return format(schema.methods[method][0], inputs, true, schema.methods[method][2]);
}