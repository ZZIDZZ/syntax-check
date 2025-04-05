function _loop2(_name) {
      var klass = resolve(associations[_name].klass);
      var data = associated[_name];

      // clear association
      if (!data) {
        model[_name] = null;
        return "continue";
      }

      if (associations[_name].type === 'hasOne') {
        var other = (typeof data === "undefined" ? "undefined" : _typeof(data)) === 'object' ? klass.load(data) : klass.local(data);
        model[_name] = other;
      } else if (associations[_name].type === 'hasMany') {
        var others = [];
        data.forEach(function (o) {
          others.push((typeof o === "undefined" ? "undefined" : _typeof(o)) === 'object' ? klass.load(o) : klass.local(o));
        });
        model[_name] = others;
      }
    }