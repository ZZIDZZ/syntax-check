def default(self, obj):
    """Overriding the default JSONEncoder.default for NDB support."""
    obj_type = type(obj)
    # NDB Models return a repr to calls from type().
    if obj_type not in self._ndb_type_encoding:
      if hasattr(obj, '__metaclass__'):
        obj_type = obj.__metaclass__
      else:
        # Try to encode subclasses of types
        for ndb_type in NDB_TYPES:
          if isinstance(obj, ndb_type):
            obj_type = ndb_type
            break

    fn = self._ndb_type_encoding.get(obj_type)

    if fn:
      return fn(obj)

    return json.JSONEncoder.default(self, obj)