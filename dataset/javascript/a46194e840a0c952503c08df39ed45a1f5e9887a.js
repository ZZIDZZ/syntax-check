function(config) {
        if (!this._store) {
            this._store = [
                {
                    first: 'Robert',
                    last: 'Dougan',
                    emails: {
                        work: 'rob@sencha.com'
                    }
                },
                {
                    first: 'Jamie',
                    last: 'Avins',
                    emails: {
                        work: 'jamie@sencha.com'
                    }
                }
            ];
        }

        config.success.call(config.scope || this, this._store);
    }