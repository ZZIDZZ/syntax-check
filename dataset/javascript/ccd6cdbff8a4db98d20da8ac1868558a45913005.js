function getExampleCode(comment) {
  var expectedResult = comment.expectedResult;
  var isAsync = comment.isAsync;
  var testCase = comment.testCase;

  if(isAsync) {
    return '\nfunction cb(err, result) {' +
      'if(err) return done(err);' +
      'result.should.eql(' + expectedResult + ');' +
      'done();' +
    '}\n' +
    'var returnValue = ' + testCase + ';' +
    'if(returnValue && returnValue.then && typeof returnValue.then === \'function\') {' +
      'returnValue.then(cb.bind(null, null), cb);' +
    '}';
  } else {
    return '(' + testCase + ').should.eql(' + expectedResult + ');';
  }
}