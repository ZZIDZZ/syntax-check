protected List<Class<?>> getPojoRules() {
    Reflections reflections = new Reflections(_package);

    List<Class<?>> rules = reflections
        .getTypesAnnotatedWith(com.deliveredtechnologies.rulebook.annotation.Rule.class).stream()
        .filter(rule -> rule.getAnnotatedSuperclass() != null) // Include classes only, exclude interfaces, etc.
        .filter(rule -> _subPkgMatch.test(rule.getPackage().getName()))
        .collect(Collectors.toList());

    rules.sort(comparingInt(aClass ->
        getAnnotation(com.deliveredtechnologies.rulebook.annotation.Rule.class, aClass).order()));

    return rules;
  }