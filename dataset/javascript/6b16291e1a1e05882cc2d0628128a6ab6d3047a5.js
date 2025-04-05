function encodeUserAuth(user) {
  if (!user) {
    return null;
  }

  var token = user.token;
  if (token) {
    var sha1 = typeof token === 'object' ? token.sha1 : token;
    return 'token ' + sha1;
  }

  return 'Basic ' + base64.encode(user.username + ':' + user.password)
}