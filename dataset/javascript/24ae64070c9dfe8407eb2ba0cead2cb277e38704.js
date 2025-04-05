function verifyRequest(req, res, buf, encoding) {
    var expected = req.headers['x-hub-signature'];
    var calculated = getSignature(buf);
    if (expected !== calculated) {
      throw new Error('Invalid signature on incoming request');
    } else {
      // facebook_botkit.logger.debug('** X-Hub Verification successful!')
    }
  }