function create(text) {
    return Tools.instance({
        text,
        pos: 0
    }, {
        isDone,
        getPos,
        expect,
        accept,
        expectRE,
        acceptRE,
        goto
    });
}