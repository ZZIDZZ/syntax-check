function makeRequest(url, path, params, callback) {
        try {
            log("Sending HTTP request");
            var serverOptions = parseUrl(url);
            var data = prepareParams(params);
            var method = "GET";
            var options = {
                host: serverOptions.host,
                port: serverOptions.port,
                path: path+"?"+data,
                method: "GET"
            };
            
            if(data.length >= 2000){
                method = "POST";
            }
            else if(Countly.force_post){
                method = "POST";
            }
            
            if(method === "POST"){
                options.method = "POST";
                options.path = path;
                options.headers = {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Content-Length": Buffer.byteLength(data)
                };
            }
            var protocol = http;
            if(url.indexOf("https") === 0){
                protocol = https;
            }
            var req = protocol.request(options, function(res) {
                var str = "";
                res.on("data", function (chunk) {
                    str += chunk;
                });
            
                res.on("end", function () {
                    if(res.statusCode >= 200 && res.statusCode < 300){
                        callback(false, params, str);
                    }
                    else{
                        callback(true, params);
                    }
                });
            });
            if(method === "POST"){
                // write data to request body
                req.write(data);
            }

            req.on("error", function(err){
                log("Connection failed.", err);
                if (typeof callback === "function") {
                    callback(true, params);
                }
            });

            req.end();
        } catch (e) {
            // fallback
            log("Failed HTTP request", e);
            if (typeof callback === "function") { callback(true, params); }
        }
    }