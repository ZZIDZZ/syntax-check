public boolean hasParserForWhoisHost(String whoisHost) {
        container.put("host", whoisHost);
        return (Boolean) container.runScriptlet(
                JRubyWhois.class.getResourceAsStream("jruby-has-parser.rb"),
                "jruby-has-parser.rb");
    }