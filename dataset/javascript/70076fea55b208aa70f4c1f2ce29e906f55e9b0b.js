function toHaveText() {
      return {
        compare: function compare(element, text) {
          var regexp = text instanceof RegExp ? text : new RegExp(text, 'ig');
          var pass = element.getDOMNode().textContent.match(regexp);
          var message = pass ? 'Text "' + text + '" is found within an element' : 'Text "' + text + '" is not found within an element';
          return { pass: pass, message: message };
        }
      };
    }