function init() {
    // Next
    bindShortcut(['right'], function(e) {
        navigation.goNext();
    });

    // Prev
    bindShortcut(['left'], function(e) {
        navigation.goPrev();
    });

    // Toggle Summary
    bindShortcut(['s'], function(e) {
        sidebar.toggle();
    });
}