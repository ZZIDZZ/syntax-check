function dd(object, _context, _key, _root, _rootPath) {
    _root = _root || object;
    _rootPath = _rootPath || [];
    var drill = function(key) {
        var nextObject = (
            object &&
            object.hasOwnProperty(key) &&
            object[key] ||
            undefined
        );
        return dd(nextObject, object, key, _root, _rootPath.concat(key));
    };
    drill.val = object;
    drill.exists = object !== undefined;
    drill.set = function(value) {
        if (_rootPath.length === 0) {
            return;
        }
        var contextIterator = _root;
        for (var depth = 0; depth < _rootPath.length; depth++) {
            var key = _rootPath[depth];
            var isFinalDepth = (depth === _rootPath.length - 1);
            if (!isFinalDepth) {
                contextIterator[key] = (
                    contextIterator.hasOwnProperty(key) &&
                    typeof contextIterator[key] === 'object' ?
                        contextIterator[key] : {}
                );
                contextIterator = contextIterator[key];
            } else {
                _context = contextIterator;
                _key = key;
            }
        }
        _context[_key] = value;
        drill.val = value;
        drill.exists = value !== undefined;
        return value;
    };
    drill.update = function(value) {
        if (drill.exists) {
            _context[_key] = value;
            drill.val = value;
            return value;
        }
    };
    drill.invoke = isFunction(object) ? Function.prototype.bind.call(object, _context) : function () {
    };

    return drill;
}