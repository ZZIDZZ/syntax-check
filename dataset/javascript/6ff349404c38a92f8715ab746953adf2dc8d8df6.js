function(child, element, root) {
        this._children.push(child);
        (root || this.root).insertBefore(child.root, element);
        (root || this.root).removeChild(element);
    }