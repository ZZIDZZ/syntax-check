function parseSimpleString(parser) {
  var offset = parser.offset;
  var length = parser.buffer.length;
  var string = '';

  while (offset < length) {
    var c1 = parser.buffer[offset++];
    if (c1 === 13) {
      var c2 = parser.buffer[offset++];
      if (c2 === 10) {
        parser.offset = offset;
        return string;
      }
      string += String.fromCharCode(c1) + String.fromCharCode(c2);
      continue;
    }
    string += String.fromCharCode(c1);
  }
  return undefined;
}