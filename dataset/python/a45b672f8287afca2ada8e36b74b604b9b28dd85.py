def _universal_newlines(fp):
  """
    Wrap a file to convert newlines regardless of whether the file was opened
    with the "universal newlines" option or not.
  """
  # if file was opened with universal newline support we don't need to convert
  if 'U' in getattr(fp, 'mode', ''):
    for line in fp:
      yield line
  else:
    for line in fp:
      line = line.replace(b'\r\n', b'\n').replace(b'\r', b'\n')
      for piece in line.split(b'\n'):
        yield piece