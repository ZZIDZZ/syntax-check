function dummyText ( opts ) {
        var corpus = opts.corpus || 'lorem',
            i = opts.start,
            isRandom = typeof(i) === 'undefined',
            mustReset = typeof(origin) === 'undefined',
            skip = opts.skip || 1,
            sentences = opts.sentences || 1,
            words = opts.words,
            text = texts[corpus] || texts.lorem,
            len = text.length,
            output = [],
            s;

        if ( isRandom ) {
            i = Math.floor( Math.random() * len );
        }

        if ( mustReset ) {
            origin = i;
        }

        if ( isRandom ) {
            // possible modulo of a negative number, so take care here.
            i = ((i + len - origin) % len + len) % len;
        }

        while( sentences-- ) {
            s = text[i];
            if ( words ) {
                s = s.split(' ').slice(0,words).join(' ');
            }
            output.push( s );
            i = (i + skip) % len;
        }

        return output.join(' ');
    }