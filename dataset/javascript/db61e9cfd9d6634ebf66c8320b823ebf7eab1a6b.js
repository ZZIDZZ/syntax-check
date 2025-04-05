function isSameOrigin(requestUrl) {
        var parsed = (typeof requestUrl === 'string') ? resolve(requestUrl, true) : requestUrl;
        return (parsed.protocol === originUrl.protocol &&
                parsed.host === originUrl.host);
      }