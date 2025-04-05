function getPropertyDoppelganger(property, isRtl) {
  const convertedProperty = isRtl
    ? propertiesToConvert.rtl[property]
    : propertiesToConvert.ltr[property]

  return convertedProperty || property
}