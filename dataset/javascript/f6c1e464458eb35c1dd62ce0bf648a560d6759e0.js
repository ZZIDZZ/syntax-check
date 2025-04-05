function transformBody(req, input) {
  req.log.debug('attempting transformation', input);

  const body = input.data;
  const { attributes } = body;
  const { password, referral } = attributes;
  const { autoGeneratePassword } = config;

  if (autoGeneratePassword === true && password) {
    throw new Errors.ValidationError('password is auto-generated, do not pass it', 400);
  }

  if (autoGeneratePassword === false && !password) {
    throw new Errors.ValidationError('password must be provided', 400);
  }

  const { country } = body;
  if (country && !countryData.info(country, 'ISO3')) {
    const err = `country name must be specified as ISO3.
    Please refer to https://github.com/therebelrobot/countryjs#info for a complete list of codes`;
    throw new Errors.ValidationError(err, 400, 'data.country');
  }

  const message = {
    username: body.id,
    metadata: ld.pick(attributes, WHITE_LIST),
    activate: config.usersRequireActivate !== true || !password,
    audience: getAudience(),
    ipaddress: proxyaddr(req, config.trustProxy),
  };

  if (password) {
    message.password = password;
  }

  if (attributes.alias) {
    message.alias = attributes.alias.toLowerCase();
  }

  if (referral) {
    message.referral = referral;
  }

  // BC, remap additionalInformation to longDescription if it is not provided
  if (attributes.additionalInformation && !message.metadata.longDescription) {
    message.metadata.longDescription = attributes.additionalInformation;
  }

  return message;
}