function (environment, baseConfig) {
    if ('emoji' in baseConfig) {
      if (!baseConfig.emoji) {
        _emojiConfig = false;
      } else {
        Object.keys(_defaultEmojiConfig).forEach(function (key) {
          _emojiConfig[key] = baseConfig.emoji.hasOwnProperty(key) ? baseConfig.emoji[key] : _defaultEmojiConfig[key];
        });
      }
    } else {
      _emojiConfig = _defaultEmojiConfig;
    }

    if (environment === 'development') {
      return {
        emoji: _emojiConfig,
        contentSecurityPolicy: {
          'script-src': "'self' 'unsafe-eval' 'unsafe-inline'"
        }
      };
    }

    return {
      emoji: _emojiConfig
    };
  }