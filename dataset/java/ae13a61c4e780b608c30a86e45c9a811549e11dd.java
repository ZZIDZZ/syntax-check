public String compileScript(String script) throws IOException {
        if (script == null || script.isEmpty()) {
            return null;
        }
        HttpPost request = new HttpPost(uri.resolve("/utils/script/compile"));
        request.setEntity(new StringEntity(script));
        return parse(exec(request), "script").asText();
    }