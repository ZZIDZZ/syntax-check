private void sendHttpRequest(final Request request, final org.boon.core.Handler<Response> responseHandler) {

        final HttpClientRequest httpClientRequest = httpClient.request(request.getMethod(), request.uri(),
                handleResponse(request, responseHandler));


        final Runnable runnable = new Runnable() {
            @Override
            public void run() {

                if (!request.getMethod().equals("GET")) {
                    httpClientRequest.putHeader("Content-Type", "application/x-www-form-urlencoded").end(request.paramBody());
                } else {
                    httpClientRequest.end();
                }

            }
        };



        if (closed.get()) {
            this.scheduledExecutorService.schedule(new Runnable() {
                @Override
                public void run() {
                    connect();
                    int retry = 0;
                    while (closed.get()) {
                        Sys.sleep(1000);

                        if (!closed.get()) {
                            break;
                        }
                        retry++;
                        if (retry>10) {
                            break;
                        }

                        if ( retry % 3 == 0 ) {
                            connect();
                        }
                    }

                    if (!closed.get()) {
                        runnable.run();
                    } else {
                        responseHandler.handle(new Response("TIMEOUT", -1, new Error(-1, "Timeout", "Timeout", -1L)));
                    }
                }
            }, 10, TimeUnit.MILLISECONDS);
        } else {
            runnable.run();
        }



    }