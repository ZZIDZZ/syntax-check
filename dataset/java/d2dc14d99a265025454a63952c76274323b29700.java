public boolean copyToken() {
		if (context.getAccessToken() == null) {
			Authentication authentication = SecurityContextHolder.getContext()
					.getAuthentication();
			if (authentication != null) {
				Object details = authentication.getDetails();
				if (details instanceof OAuth2AuthenticationDetails) {
					OAuth2AuthenticationDetails holder = (OAuth2AuthenticationDetails) details;
					String token = holder.getTokenValue();
					DefaultOAuth2AccessToken accessToken = new DefaultOAuth2AccessToken(
							token);
					String tokenType = holder.getTokenType();
					if (tokenType != null) {
						accessToken.setTokenType(tokenType);
					}
					context.setAccessToken(accessToken);
					return true;
				}
			}
		}
		return false;
	}