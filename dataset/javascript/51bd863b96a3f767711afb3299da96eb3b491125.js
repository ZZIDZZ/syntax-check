function (sub_node) {
                if ( sub_node ) {
                    walk(sub_node, depth + 1);

                } else if ( node.pages ) {
                    node.pages.forEach(function (sub_node, name) {
                        walk(sub_node, depth + 1);
                    });
                }
            }