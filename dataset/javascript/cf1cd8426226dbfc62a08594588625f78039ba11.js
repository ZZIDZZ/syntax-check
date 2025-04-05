function serverRequest(config) {
                var defer = $q.defer();
                if (provider.debug) $log.info('$sails ' + config.method + ' ' + config.url, config.data || '');

                if (config.timeout > 0) {
                    $timeout(timeoutRequest, config.timeout);
                } else if (isPromiseLike(config.timeout)) {
                    config.timeout.then(timeoutRequest);
                }

                socket['legacy_' + config.method.toLowerCase()](config.url, config.data, serverResponse);

                function timeoutRequest(){
                    serverResponse(null);
                }

                function serverResponse(result, jwr) {

                    if (!jwr) {
                        jwr = {
                            body: result,
                            headers: result.headers || {},
                            statusCode: result.statusCode || result.status || 0,
                            error: (function() {
                                if (this.statusCode < 200 || this.statusCode >= 400) {
                                    return this.body || this.statusCode;
                                }
                            })()
                        };
                    }

                    jwr.data = jwr.body; // $http compat
                    jwr.status = jwr.statusCode; // $http compat
                    jwr.socket = socket;
                    jwr.url = config.url;
                    jwr.method = config.method;
                    jwr.config = config.config;
                    if (jwr.error) {
                        if (provider.debug) $log.warn('$sails response ' + jwr.statusCode + ' ' + config.url, jwr);
                        defer.reject(jwr);
                    } else {
                        if (provider.debug) $log.info('$sails response ' + config.url, jwr);
                        defer.resolve(jwr);
                    }
                }

                return defer.promise;
            }