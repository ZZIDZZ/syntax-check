function(e) {
            var el = e.target, attr,
                type = e.type,
                key = type.indexOf('key') === 0 ? e.which || e.keyCode || '' : '',
                special = _.special[type+key];
            if (el && special) {
                type = special(e, el, el.nodeName.toLowerCase());
                if (!type){ return; }// special said to ignore it!
            }
            el = _.find(el, type),
            attr = _.attr(el, type);
            if (attr) {
                _.all(el, attr, e);
                if (type === 'click' && !_.boxRE.test(el.type)) {
                    e.preventDefault();
                }
            }
        }