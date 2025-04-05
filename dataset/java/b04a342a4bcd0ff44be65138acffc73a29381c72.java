public void unloadQueue(Response response) {
        for (Cookie cookie : this.queue) {
            response.addCookieHeader(cookie.getHTTPHeader());
        }
    }