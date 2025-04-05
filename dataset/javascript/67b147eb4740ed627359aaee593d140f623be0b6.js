function extractApis(services) {
                            var filterTypes = arguments.length <= 1 || arguments[1] === undefined ? [] : arguments[1];

                            services = Array.isArray(services) ? services : [services];
                            var apis = services.reduce(function (total, service) {
                                var obj = service.constructor === Object ? service : Object.getPrototypeOf(service);
                                var keys = aggregateApisByType(obj, total, filterTypes);
                                total.push.apply(total, keys);
                                return total;
                            }, []);

                            return apis;
                        }