function shapefileParams (cmd, options) {
  // make sure geometries are still written even if the first is null
  if (options.geometry !== 'NONE') cmd.push('-nlt', options.geometry.toUpperCase())
  cmd.push('-fieldmap', 'identity')
  if (!options.ignoreShpLimit) cmd.push('-lco', '2GB_LIMIT=yes')
  if (options.srs) cmd.push('-t_srs', options.srs)
  return cmd
}