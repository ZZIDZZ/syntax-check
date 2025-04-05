function(schema) {
  this._decoders = decoders;
  this._encoders = encoders;
  this._schemas = {};

  // Allow to pass the fields direclty
  if(Object.keys(schema).join(',') !== 'name,fields'){
    schema = {
      name: '_auto-' + new Date().getTime(),
      fields: schema
    };
  }

  this._schema = schema;
  this._fieldIndex = Object.keys(schema.fields);
  this._schemas[schema.name] = schema;
}