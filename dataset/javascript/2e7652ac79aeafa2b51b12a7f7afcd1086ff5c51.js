function resetProviders(names) {
        var tempProviders = this.originalProviders;
        var shouldFilter = Array.isArray(names);
    
        Object.keys(this.originalProviders).forEach(function resetProvider(originalProviderName) {
            if (shouldFilter && names.indexOf(originalProviderName) === -1) {
                return;
            }
            var parts = originalProviderName.split(DELIMITER);
            if (parts.length > 1) {
                parts.forEach(removeProviderMap, getNestedBottle.call(this, parts[0]));
            }
            removeProviderMap.call(this, originalProviderName);
            this.provider(originalProviderName, tempProviders[originalProviderName]);
        }, this);
    }