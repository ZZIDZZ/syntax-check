function arrayProperty (values, indentLength = 1, inArray = 0) {
    if (values.length === 0) {
      return ' []';
    }

    let str = '\n';
    const arrayPrefix = getPrefix(indentLength, indentChars);

    values
      .forEach((value) => {
        const type = typeOf(value);
        const inArrayPrefix = getPrefix(inArray, '  ');
        const valueString = checkCircular(value) ? '[Circular]' : typifiedString(type, value, indentLength, inArray + 1)
          .toString()
          .trimLeft();

        str += `${
          inArrayPrefix
        }${
          arrayPrefix
        }- ${
          valueString
        }\n`;
      });

    return str.substring(0, str.length - 1);
  }