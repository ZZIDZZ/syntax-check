function() {
        var templates = { data: {} };

        var stringTemplateSource = function(template) {
            this.text = function(value) {
                if (arguments.length === 0) {
                    return templates[template];
                }
                templates[template] = value;
            };
        };

        var templateEngine = new ko.nativeTemplateEngine();
        templateEngine.makeTemplateSource = function(template) {
            return new stringTemplateSource(template);
        };

        templateEngine.addTemplate = function(key, value) {
            templates[key] = value;
        };

        return templateEngine;
    }