function splitHeader(content) {
    // New line characters need to handle all operating systems.
    const lines = content.split(/\r?\n/);
    if (lines[0] !== '---') {
        return {};
    }
    let i = 1;
    for (; i < lines.length - 1; ++i) {
        if (lines[i] === '---') {
            break;
        }
    }
    return {
        header: lines.slice(1, i + 1).join('\n'),
        content: lines.slice(i + 1).join('\n'),
    };
}