async function (server, options) {
        try {
            var internal = new Internal(options);
        } catch (err) {
            throw new Boom(err);
        }

        /**
         * @module exposed
         * @description
         * Exposed functions and attributes are listed under exposed name.
         * To access those attributes `request.server.plugins['hapi-locale']` can be used.
         * @example
         * var locales = request.server.plugins['hapi-locale'].getLocales(); // ['tr_TR', 'en_US'] etc.
         */

        /**
         * Returns all available locales as an array.
         * @name getLocales
         * @function
         * @returns {Array.<string>}    - Array of locales.
         * @example
         * var locales = request.server.plugins['hapi-locale'].getLocales(); // ['tr_TR', 'en_US'] etc.
         */
        server.expose('getLocales', function getLocales() {
            return internal.locales;
        });

        /**
         * Returns default locale.
         * @name getDefaultLocale
         * @function
         * @returns {string}    - Default locale
         */
        server.expose('getDefaultLocale', function getDefaultLocale() {
            return internal.default;
        });

        /**
         * Returns requested language.
         * @name getLocale
         * @function
         * @param {Object}      request - Hapi.js request object
         * @returns {string}    Locale
         */
        server.expose('getLocale', function getLocale(request) {
            try {
                return lodash.get(request, internal.options.getter)();
            } catch (err) {
                return null;
            }
        });

        server.ext(internal.options.onEvent, internal.processRequest, {bind: internal});
    }