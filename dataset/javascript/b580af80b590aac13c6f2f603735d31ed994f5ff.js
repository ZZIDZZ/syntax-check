function extractValue(attr, node) {
                    if (attr === 'translate') {
                        return node.html() || getAttr(attr) || '';
                    }
                    return getAttr(attr) || node.html() || '';
                }