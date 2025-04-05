function(ast, bodyContent) {
      var macro = this.macros[ast.id];
      var ret = '';

      if (!macro) {

        var jsmacros = this.jsmacros;
        macro = jsmacros[ast.id];
        var jsArgs = [];

        if (macro && macro.apply) {

          utils.forEach(ast.args, function(a) {
            jsArgs.push(this.getLiteral(a));
          }, this);

          var self = this;

          // bug修复：此处由于闭包特性，导致eval函数执行时的this对象是上一次函数执行时的this对象，渲染时上下文发生错误。
          jsmacros.eval = function() {
            return self.eval.apply(self, arguments);
          };


          try {
            ret = macro.apply(jsmacros, jsArgs);
          } catch (e) {
            var pos = ast.pos;
            var text = Velocity.Helper.getRefText(ast);
            // throws error tree
            var err = '\n      at ' + text + ' L/N ' + pos.first_line + ':' + pos.first_column;
            e.name = '';
            e.message += err;
            throw new Error(e);
          }

        }

      } else {
        var asts = macro.asts;
        var args = macro.args;
        var callArgs = ast.args;
        var local = { bodyContent: bodyContent };
        var guid = utils.guid();
        var contextId = 'macro:' + ast.id + ':' + guid;

        utils.forEach(args, function(ref, i) {
          if (callArgs[i]) {
            local[ref.id] = this.getLiteral(callArgs[i]);
          } else {
            local[ref.id] = undefined;
          }
        }, this);

        ret = this.eval(asts, local, contextId);
      }

      return ret;
    }