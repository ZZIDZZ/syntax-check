def validate_changeset(changeset):
  """Validate a changeset is compatible with Amazon's API spec.

  Args: changeset: lxml.etree.Element (<ChangeResourceRecordSetsRequest>)
  Returns: [ errors ] list of error strings or []."""
  errors = []
  changes = changeset.findall('.//{%s}Change' % R53_XMLNS)
  num_changes = len(changes)
  if num_changes == 0:
    errors.append('changeset must have at least one <Change> element')
  if num_changes > 100:
    errors.append('changeset has %d <Change> elements: max is 100' % num_changes)
  rrs = changeset.findall('.//{%s}ResourceRecord' % R53_XMLNS)
  num_rrs = len(rrs)
  if num_rrs > 1000:
    errors.append('changeset has %d ResourceRecord elements: max is 1000' % num_rrs)
  values = changeset.findall('.//{%s}Value' % R53_XMLNS)
  num_chars = 0
  for value in values:
    num_chars += len(value.text)
  if num_chars > 10000:
    errors.append('changeset has %d chars in <Value> text: max is 10000' % num_chars)
  return errors