function realWidth(str) {
    if (str == null)
        return 0;
    str = stripANSI(str);
    return str.length + (stripEmoji(str).match(/[^\x00-\xff]/g) || []).length;
}