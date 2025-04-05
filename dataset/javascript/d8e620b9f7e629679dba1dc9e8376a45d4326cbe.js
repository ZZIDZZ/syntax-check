function calcViewport() {
        var scrollTop = $window.scrollTop(),
            scrollLeft = window.pageXOffset || 0,
            edgeX = options.edgeX,
            edgeY = options.edgeY;

        viewportTop = scrollTop - edgeY;
        viewportBottom = scrollTop + (window.innerHeight || $window.height()) + edgeY;
        viewportLeft = scrollLeft - edgeX;
        viewportRight = scrollLeft + (window.innerWidth || $window.width()) + edgeX;
    }