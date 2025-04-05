function (error) {
    if (error) {
      // Pass an user defined error back to the original request call
      return callback(new CaptchaError(error, options, response));
    }

    onSubmitCaptcha(options, response, body);
  }