function Webtask (sandbox, token, options) {
    if (!options) options = {};
 
    if (sandbox.securityVersion === 'v1') {
        try {
            /**
             * @property claims - The claims embedded in the Webtask's token
             */
            this.claims = Decode(token);

            /**
             * @property token - The token associated with this webtask
             */
            this.token = token;
        }
        catch (_) {
            throw new Error('token must be a valid JWT');
        }
    }
 
    if (sandbox.securityVersion === 'v2') {
        if (typeof options.name !== 'string') {
            throw new Error('name must be a valid string');
        }

        this.claims = {
            jtn: options.name,
            ten: options.container || sandbox.container,
        }
    }

    /**
     * @property sandbox - The {@see Sandbox} instance used to create this Webtask instance
     */
    this.sandbox = sandbox;

    /**
     * @property meta - The metadata associated with this webtask
     */
    this.meta = options.meta || {};

    /**
     * @property secrets - The secrets associated with this webtask if `decrypt=true`
     */
    this.secrets = options.secrets;

    /**
     * @property code - The code associated with this webtask if `fetch_code=true`
     */
    this.code = options.code;    

    /**
     * @property container - The container name in which the webtask will run
     */
    Object.defineProperty(this, 'container', {
        enumerable: true,
        get: function () {
            return options.container || this.sandbox.container;
        }
    });

    /**
     * @property url - The public url that can be used to invoke this webtask
     */
    Object.defineProperty(this, 'url', {
        enumerable: true,
        get: function () {
            var url = options.webtask_url;
            if (!url) {
                if (this.claims.host) {
                   var surl = Url.parse(this.sandbox.url);
                   url = surl.protocol + '//' + this.claims.host + (surl.port ? (':' + surl.port) : '') + '/' + this.sandbox.container;
                }
                else {
                   url = this.sandbox.url + '/api/run/' + this.sandbox.container;
                }

                if (this.claims.jtn) url += '/' + this.claims.jtn;
                else url += '?key=' + this.token;
            }

            return url;
        }
    });
}