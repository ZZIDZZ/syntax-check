function formatMessage (str) {
  return String(str).split('\n')
    .map(function(s) {
      return s.magenta;
    })
    .join('\n');
}