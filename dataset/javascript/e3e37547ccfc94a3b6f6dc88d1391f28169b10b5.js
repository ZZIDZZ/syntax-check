function () {
            for (var i = 0; i < this.config.methods.length; i++) {
                var key = this.config.methods[i];

                // Only create analytics stub if it doesn't already exist
                if (!analytics[key]) {
                    analytics[key] = analytics.factory(key);
                }

                this[key] = this.factory(key);
            }
        }