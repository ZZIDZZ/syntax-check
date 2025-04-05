function () {
        // Apply the modifier to the current `options`
        options = lodash.assign(options, modifier);

        // Create new wrapper function.
        var AkamaiPurgeChain = function AkamaiPurgeChain (username, password, objects) {
          return AkamaiPurge(username, password, objects, options);
        };

        // Apply new modifiers to given wrapper function
        applyModifiers(AkamaiPurgeChain, options);

        // Expose current `options`
        AkamaiPurgeChain.options = options;

        return AkamaiPurgeChain;
      }