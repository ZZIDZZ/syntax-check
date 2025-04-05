public void setDefaultConfiguration(Reader defaultConfig) {
		XProcConfiguration config = new XProcConfiguration("he", false);
		try {
			nextDefaultConfig = config.getProcessor().newDocumentBuilder()
				.build(new SAXSource(new InputSource(defaultConfig))); }
		catch (SaxonApiException e) {
			throw new RuntimeException(e); }
	}