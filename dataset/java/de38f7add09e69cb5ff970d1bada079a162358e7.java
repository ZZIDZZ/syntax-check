public DeclarationFilter or(DeclarationFilter f) {
		final DeclarationFilter f1 = this;
		final DeclarationFilter f2 = f;
		return new DeclarationFilter() {
			public boolean matches(Declaration d) {
				return f1.matches(d) || f2.matches(d);
			}
		};
	}