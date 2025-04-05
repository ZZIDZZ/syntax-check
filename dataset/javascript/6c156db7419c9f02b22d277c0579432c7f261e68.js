function(error, data, uri) {
        // var output = '<div id="error">' +
        //    this.stringbundle.GetStringFromName('errorParsing') + '</div>';
        // output += '<h1>' +
        //    this.stringbundle.GetStringFromName('docContents') + ':</h1>';
        var output = '<div id="error">Error parsing JSON: ' +
        error.message+'</div>'
        output += '<h1>'+error.stack+':</h1>';
        output += '<div id="jsonview">' + this.htmlEncode(data) + '</div>';
        return this.toHTML(output, uri + ' - Error');
    }