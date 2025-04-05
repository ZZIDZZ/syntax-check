def validate(
    message,
    get_certificate=lambda url: urlopen(url).read(),
    certificate_url_regex=DEFAULT_CERTIFICATE_URL_REGEX,
    max_age=DEFAULT_MAX_AGE
):
    """
    Validate a decoded SNS message.

    Parameters:
        message:
            Decoded SNS message.

        get_certificate:
            Function that receives a URL, and returns the certificate from that
            URL as a string. The default doesn't implement caching.

        certificate_url_regex:
            Regex that validates the signing certificate URL. Default value
            checks it's hosted on an AWS-controlled domain, in the format
            "https://sns.<data-center>.amazonaws.com/"

        max_age:
            Maximum age of an SNS message before it fails validation, expressed
            as a `datetime.timedelta`. Defaults to one hour, the max. lifetime
            of an SNS message.
    """

    # Check the signing certicate URL.
    SigningCertURLValidator(certificate_url_regex).validate(message)

    # Check the message age.
    if not isinstance(max_age, datetime.timedelta):
        raise ValueError("max_age must be None or a timedelta object")
    MessageAgeValidator(max_age).validate(message)

    # Passed the basic checks, let's download the cert.
    # We've validated the URL, so aren't worried about a malicious server.
    certificate = get_certificate(message["SigningCertURL"])

    # Check the cryptographic signature.
    SignatureValidator(certificate).validate(message)