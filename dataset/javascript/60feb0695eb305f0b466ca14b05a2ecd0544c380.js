function lookupGithubLogin (p, print, callback) {
  var apiURI = 'https://api.github.com/search/users?q='
  var options = { json: true, headers: { 'user-agent': pkg.name + '/' + pkg.version } }
  if (process.env.OAUTH_TOKEN) {
    options.headers['Authorization'] = 'token ' + process.env.OAUTH_TOKEN.trim()
  }
  function cb (err, p) {
    callback(err, p)
  }
  if (print) process.stdout.write('.')

  request(apiURI + encodeURIComponent(p.email + ' in:email type:user'), options, onEmail)
  function onEmail (err, data) {
    rateLimitExceeded = rateLimitExceeded || data.body.message
    if (!err && data.body.items && data.body.items[0]) {
      p.login = data.body.items[0].login
      return cb(err, p)
    }
    request(apiURI + encodeURIComponent(p.name + ' in:fullname type:user'), options, onName)
  }
  function onName (err, data) {
    rateLimitExceeded = rateLimitExceeded || data.body.message
    if (!err && data.body.items && data.body.items[0]) {
      p.login = data.body.items[0].login
      return cb(err, p)
    }
    cb(err, p)
  }
}