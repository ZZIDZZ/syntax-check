function(imapMessage) {
    var deferred = Q.defer();
    var message = new Message();

    imapMessage.on('body', function(stream, info) {
        var buffer = '';

        stream.on('data', function(chunk) {
            buffer += chunk.toString('utf8');
        });

        stream.on('end', function() {
            if (info.which === 'TEXT') {
                message.body = buffer;
            } else {
                message.headers = Imap.parseHeader(buffer);
            }
        });
    });

    imapMessage.on('attributes', function(attrs) {
        message.attributes = attrs;
    });

    imapMessage.on('end', function() {
        deferred.resolve(message);
    });

    return deferred.promise;
}