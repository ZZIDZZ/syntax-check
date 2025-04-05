function _jqGetValue($el, args){
    var el = $el[0],
      child = el.firstChild

    // Return the instance if the element has an oj instance
    if (oj.isOJInstance(_getInstanceOnElement(el)))
      return _getInstanceOnElement(el)

    // Parse the text to turn it into bool, number, or string
    else if (oj.isDOMText(child))
      return oj.parse(child.nodeValue)

    // Return the first child otherwise as an oj instance or child element
    else if (oj.isDOMElement(child))
      return _d(_getInstanceOnElement(child), child)
  }