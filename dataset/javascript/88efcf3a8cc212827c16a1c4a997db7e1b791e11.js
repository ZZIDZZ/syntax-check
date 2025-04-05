function fp() {
      var args = Array.prototype.slice.call(arguments, 0);
      if (args.length) {
        if (!args.every(isStringOrFunction)) {
          var signature = args.map(humanizeArgument).join('\n\t');
          throw new Error('Invalid arguments to functional pipeline - not a string or function\n\t' +
            signature);
        }

        var fns = splitDots(args);
        return function (d) {
          var originalObject = d;
          fns.forEach(function (fn) {
            if (typeof fn === 'string') {
              if (typeof d[fn] === 'function') {
                d = d[fn].call(d, d);
              } else if (typeof d[fn] !== 'undefined') {
                d = d[fn];
              } else {
                var signature = args.map(humanizeArgument).join('\n\t');
                throw new Error('Cannot use property ' + fn + ' from object ' +
                  JSON.stringify(d, null, 2) + '\npipeline\n\t' + signature +
                  '\noriginal object\n' + JSON.stringify(originalObject, null, 2));
              }
            } else if (typeof fn === 'function') {
              d = fn(d);
            } else {
              throw new Error('Cannot apply ' + JSON.stringify(fn, null, 2) +
                ' to value ' + d + ' not a property name or a function');
            }
          });
          return d;
        };
      }
    }