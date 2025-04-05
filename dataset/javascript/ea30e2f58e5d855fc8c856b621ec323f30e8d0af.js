function getBaseScales(type, domain, range, nice, tickCount) {
  const factory = (type === 'time' && scaleUtc) || (type === 'log' && scaleLog) || scaleLinear
  const scale = createScale(factory, domain, range)
  if (nice) scale.nice(tickCount)
  return scale
}