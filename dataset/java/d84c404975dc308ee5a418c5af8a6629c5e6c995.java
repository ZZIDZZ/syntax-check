public InMemoryJavaCompiler addSource(String className, String sourceCode) throws Exception {
		sourceCodes.put(className, new SourceCode(className, sourceCode));
		return this;
	}