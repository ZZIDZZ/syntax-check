@Override
  public void updateOne(E object, String... properties) {
    if (object.getId() == null) {
      throw new RuntimeException("Not a Persisted entity");
    }
    if (properties == null || properties.length == 0) {
      entityManager.merge(object);
      return;
    }

    // for performance reason its better to mix getting fields, their values
    // and making query all in one loop
    // in one iteration
    StringBuilder sb = new StringBuilder();
    sb.append("Update " + clazz.getName() + " SET ");

    // cache of fieldName --> value
    Map<String, Object> cache = new HashMap<String, Object>();

    for (String prop : properties) {
      try {
        Field field = object.getClass().getDeclaredField(prop);
        field.setAccessible(true);
        Object value = field.get(object);
        if (value instanceof Collection) {
          // value = new LinkedList<>((Collection< ? extends Object>) value);
          throw new RuntimeException("Collection property is not suppotred.");
        }
        cache.put(prop, value);

        // ignore first comma
        if (cache.size() > 1) {
          sb.append(" ,");
        }
        sb.append(prop);
        sb.append(" = :");
        sb.append(prop);

      } catch (Exception e) { // TODO: use fine grain exceptions
                              // FIX: NEXT RELEASE I hope :)
        throw new RuntimeException(e);
      }
    }

    // this means nothing will be updated so hitting db is unnecessary
    if (cache.size() == 0)
      return;

    sb.append(" WHERE id = " + object.getId());
    Query query = entityManager.createQuery(sb.toString());
    for (Entry<String, Object> entry : cache.entrySet()) {
      query.setParameter(entry.getKey(), entry.getValue());
    }
    query.executeUpdate();
  }