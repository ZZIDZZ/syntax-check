function detectWindowWidth() {
    var mobileWidth = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 730;

    var isMobileWidth = window.innerWidth < mobileWidth;
    var body = document.body;
    if (isMobileWidth) {
        body.classList.add('is-mobile-width');
    } else {
        body.classList.remove('is-mobile-width');
    }
}