function Image(props) {
  const {
    avatar,
    bordered,
    centered,
    children,
    circular,
    className,
    content,
    dimmer,
    disabled,
    floated,
    fluid,
    hidden,
    href,
    inline,
    label,
    rounded,
    size,
    spaced,
    verticalAlign,
    wrapped,
    ui,
  } = props

  const classes = cx(
    useKeyOnly(ui, 'ui'),
    size,
    useKeyOnly(avatar, 'avatar'),
    useKeyOnly(bordered, 'bordered'),
    useKeyOnly(circular, 'circular'),
    useKeyOnly(centered, 'centered'),
    useKeyOnly(disabled, 'disabled'),
    useKeyOnly(fluid, 'fluid'),
    useKeyOnly(hidden, 'hidden'),
    useKeyOnly(inline, 'inline'),
    useKeyOnly(rounded, 'rounded'),
    useKeyOrValueAndKey(spaced, 'spaced'),
    useValueAndKey(floated, 'floated'),
    useVerticalAlignProp(verticalAlign, 'aligned'),
    'image',
    className,
  )
  const rest = getUnhandledProps(Image, props)
  const [imgTagProps, rootProps] = partitionHTMLProps(rest, { htmlProps: htmlImageProps })
  const ElementType = getElementType(Image, props, () => {
    if (
      !_.isNil(dimmer) ||
      !_.isNil(label) ||
      !_.isNil(wrapped) ||
      !childrenUtils.isNil(children)
    ) {
      return 'div'
    }
  })

  if (!childrenUtils.isNil(children)) {
    return (
      <ElementType {...rest} className={classes}>
        {children}
      </ElementType>
    )
  }
  if (!childrenUtils.isNil(content)) {
    return (
      <ElementType {...rest} className={classes}>
        {content}
      </ElementType>
    )
  }

  if (ElementType === 'img') {
    return <ElementType {...rootProps} {...imgTagProps} className={classes} />
  }
  return (
    <ElementType {...rootProps} className={classes} href={href}>
      {Dimmer.create(dimmer, { autoGenerateKey: false })}
      {Label.create(label, { autoGenerateKey: false })}
      <img {...imgTagProps} />
    </ElementType>
  )
}