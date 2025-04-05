protected <T> void bind(Class<? extends T> impl, Class<T> extensionPoint) {
        ExtensionLoaderModule<T> lm = createLoaderModule(extensionPoint);
        lm.init(impl,extensionPoint);
        install(lm);
    }