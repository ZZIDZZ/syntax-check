function render(errors) {
  if (!errors) { return ''; };
  return errors.map(function(error) {
    return error.line + ':' + error.column + ' ' +
      ' - ' + error.message + ' (' + error.ruleId +')';
  }).join('\n');
}