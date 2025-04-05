function addSignatureHeaders(body, headers, keyId, key) {
  if (!headers) {
    headers = {};
  }

  if (!headers.date) {
    headers.date = (new Date()).toUTCString();
  }

  if (!headers.digest) {
    headers.digest = 'SHA256=' + hashMsg(JSON.stringify(body), 'sha256')
        .toString('base64');
  }


  var combine = function(names, headers) {
    var parts = [];
    names.forEach(function(e) {
      parts.push(e + ': ' + headers[e]);
    });
    return parts.join('\n');
  };

  headers.authorization = 'Signature ' +
    'keyId="' + keyId + '", ' +
    'headers="date digest", ' +
    'algorithm="rsa-sha256", ' +
    'signature="' +
    signMsg(combine([ 'date', 'digest' ], headers), key, 'RSA-SHA256')
      .toString('base64') + '"';

  return headers;
}