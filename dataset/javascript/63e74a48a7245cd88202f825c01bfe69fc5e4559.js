function () {
                var r = false,
                    n = 'test_cookies_jaaulde_js',
                    v = 'data';

                this.set(n, v);

                if (this.get(n) === v) {
                    this.del(n);
                    r = true;
                }

                return r;
            }