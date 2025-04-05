function reportRequiredEndingSpace( node, token ) {
    context.report({
      node: node,
      loc: token.loc.start,
      message: 'A space is required before \'' + token.value + '\'',
      fix: function( fixer ) {
        return fixer.insertTextBefore( token, ' ' );
      }
    });
  }