function domSafeRandomGuid() {
    var _arguments = arguments;
    var _again = true;

    _function: while (_again) {
        numberOfBlocks = output = num = undefined;

        var s4 = function s4() {
            return Math.floor((1 + Math.random()) * 65536).toString(16).substring(1);
        };

        _again = false;
        var numberOfBlocks = _arguments[0] === undefined ? 4 : _arguments[0];

        var output = '';
        var num = numberOfBlocks;
        while (num > 0) {
            output += s4();
            if (num > 1) output += '-';
            num--;
        }

        if (null === document.getElementById(output)) {
            return output;
        } else {
            _arguments = [numberOfBlocks];
            _again = true;
            continue _function;
        }
    }
}