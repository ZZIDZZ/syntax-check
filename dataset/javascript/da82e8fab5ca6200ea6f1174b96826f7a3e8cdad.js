function ruleHandler(decl, result) {
    let input = decl.value;

    // Get the raw hex values and replace them
    let output = input.replace(/rgba\(#(.*?),/g, (match, hex) => {
      let rgb = hexRgb(hex),
          matchHex = new RegExp('#' + hex);
        
      // If conversion fails, emit a warning
      if (!rgb) {
        result.warn('not a valid hex', { node: decl });
        return match;
      }

      rgb = rgb.toString();
      
      return match.replace(matchHex, rgb);
    });

    decl.replaceWith({
      prop: decl.prop,
      value: output,
      important: decl.important
    });
  }