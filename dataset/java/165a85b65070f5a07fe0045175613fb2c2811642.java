public static Cookies cookies(Cookie cookie, Cookie... additionalCookies) {
        AssertParameter.notNull(cookie, "Cookie");
        final List<Cookie> cookieList = new LinkedList<Cookie>();
        cookieList.add(cookie);
        Collections.addAll(cookieList, additionalCookies);
        return new Cookies(cookieList);
    }