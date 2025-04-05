function(text, placeholders) {
        if (text[text.length - 1] == "]" && text.lastIndexOf(" [") != -1) {
            // Remove translation comments
            text = text.substr(0, text.lastIndexOf(" ["));
        }
        var replaceAll = function(str, substr, replacement) {
            return str.replace(
                new RegExp(
                    substr.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1"), "g"),
                replacement);
        }
        var localeReplace = function(text, placeholders) {
            for (var key in placeholders) {
                text = replaceAll(text, "%(" + key + ")s", placeholders[key]);
            }
            return text;
        };
        var reactLocaleReplace = function(text, placeholders) {
            var start;
            var expanded = [text];
            for (var key in placeholders) {
                start = expanded;
                expanded = [];
                for (var i = 0; i < start.length; i++) {
                    if (typeof start[i] == "string") {
                        var keyStr = "%(" + key + ")s";
                        var parts = start[i].split(keyStr);
                        var replaced = [];
                        for (var j = 0; j < parts.length - 1; j++) {
                            replaced.push(parts[j]);
                            replaced.push(placeholders[key]);
                        }
                        replaced.push(parts[parts.length - 1]);
                        replaced = replaced.filter(function (str) {
                            return str != "";
                        });
                        expanded.push.apply(expanded, replaced)
                    } else {
                        expanded.push(start[i]);
                    }
                }
            }
            return expanded;
        }
        if (placeholders) {
            var hasReactElements = false;
            for (var key in placeholders) {
                var val = placeholders[key];
                if (typeof val !== "string" && React.isValidElement(val)) {
                    hasReactElements = true;
                    break;
                }
            }
            return (hasReactElements ?
                reactLocaleReplace(text, placeholders) :
                localeReplace(text, placeholders));
        }
        return text;
    }