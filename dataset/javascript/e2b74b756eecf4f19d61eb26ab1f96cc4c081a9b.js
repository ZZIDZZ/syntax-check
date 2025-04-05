function create(EConstructor) {
  FormattedError.displayName = EConstructor.displayName || EConstructor.name

  return FormattedError

  function FormattedError(format) {
    if (format) {
      format = formatter.apply(null, arguments)
    }

    return new EConstructor(format)
  }
}