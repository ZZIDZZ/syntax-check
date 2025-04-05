function compileNode(ast) {
    var result = [], index, node, matcher;

    for(index=0;index<ast.length;index++) {
      node = ast[index];

      switch(node.type) {
        case 'a':
          matcher = curry(matchArray, [compileNode(node.nodes)]);
          break;     
        case 'o':
          matcher = curry(matchObject, [compileNode(node.nodes)]);
          break;
        case '.':
          matcher = curry(hasProperty, [compileNode(node.nodes), node.name ]);
          break;
        case ':':
          matcher = curry(hasPrototypeProperty, [compileNode(node.nodes), node.name ]);
          break;
        case '=':
          matcher = curry(equals, [node.nodes[0].type]);
          break;
        case 'd=':
          matcher = curry(equalsDate, [node.nodes[0].type]);
          break;
        case 'r=':
          matcher = curry(matchesRegex, [node.nodes[0].type]);
          break;        
        case '||':
          matcher = curry(or, [compileNode(node.nodes)]);
          break;
        case 'n':
          matcher = curry(matchType, ['number']);
          break;
        case 's':
          matcher = curry(matchType, ['string']);
          break;
        case 'S':
          matcher = matchNonBlankString;
          break;
        case 'b':
          matcher = curry(matchType, ['boolean']);
          break;
        case 'f':
          matcher = curry(matchType, ['function']);
          break;      
        case '_':
          matcher = any;
          break;
        case '|':
          matcher = rest;
          break;          
        case '()':
          matcher = matchEmptyArray;
          break;
        case 'd':
          matcher = curry(matchInstanceOf, ['[object Date]']);
          break;     
        case 'r':
          matcher = curry(matchInstanceOf, ['[object RegExp]']);
          break;               
        default:
          throw "Unknown AST entity: " + node.type;
      }

      // Bind requested. Wrap the matcher function with a call to bind.
      if (node.binding) {
        matcher = curry(bind, [node.binding, matcher]);
      }

      result[result.length] = matcher;
    }
    return result;
  }