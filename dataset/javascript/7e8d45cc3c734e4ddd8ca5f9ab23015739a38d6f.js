function register ( type, lang, handler ) {
    if (Array.isArray(lang)) {
        lang.forEach((v) => store[type].langs[v] = handler);
        return;
    }
    store[type].langs[lang] = handler;
}