protected T provision(
      Provider<? extends T> provider,
      Dependency<?> dependency,
      ConstructionContext<T> constructionContext)
      throws InternalProvisionException {
    T t = provider.get();
    if (t == null && !dependency.isNullable()) {
      InternalProvisionException.onNullInjectedIntoNonNullableDependency(source, dependency);
    }
    constructionContext.setProxyDelegates(t);
    return t;
  }