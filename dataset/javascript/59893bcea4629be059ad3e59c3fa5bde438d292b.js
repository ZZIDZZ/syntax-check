function fireEvent(type) {
    if (type in externalEventListeners) {
        // Reverse iteration is useful, if event listener is removed inside its definition
        for (var i = externalEventListeners[type].length; i > 0; i--) {
            externalEventListeners[type][externalEventListeners[type].length - i].apply(null, [].slice.call(arguments, 1));
        }
    }
}