function(selector) {
  var commaIndex = selector.indexOf(',');
  if (commaIndex !== -1) {
    selector = selector.substring(0, commaIndex);
  }

  var  types = {
    a: 0,
    b: 0,
    c: 0
  };

  // Remove the negation psuedo-class (:not) but leave its argument because specificity is calculated on its argument
  selector = selector.replace(notRegex, ' $1 ');

  // Remove anything after a left brace in case a user has pasted in a rule, not just a selector
  selector = selector.replace(ruleRegex, ' ');

  // Add attribute selectors to parts collection (type b)
  selector = findMatch(attributeRegex, 'b', types, selector);

  // Add ID selectors to parts collection (type a)
  selector = findMatch(idRegex, 'a', types, selector);

  // Add class selectors to parts collection (type b)
  selector = findMatch(classRegex, 'b', types, selector);

  // Add pseudo-element selectors to parts collection (type c)
  selector = findMatch(pseudoElementRegex, 'c', types, selector);

  // Add pseudo-class selectors to parts collection (type b)
  selector = findMatch(pseudoClassRegex, 'b', types, selector);

  // Remove universal selector and separator characters
  selector = selector.replace(separatorRegex, ' ');

  // Remove any stray dots or hashes which aren't attached to words
  // These may be present if the user is live-editing this selector
  selector = selector.replace(straysRegex, ' ');

  // The only things left should be element selectors (type c)
  findMatch(elementRegex, 'c', types, selector);

  return (types.a * 100) + (types.b * 10) + (types.c * 1);
}