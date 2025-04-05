function(strip) {

        if (!strip) {
            console.log(messagingTexts.noStrip);
        }

        if (!(strip instanceof pixel.Strip)) {
            console.log(messagingTexts.wrongStrip);
        }

        pattern.reset(strip, interval);
        setTimeout(function() {
            pattern.flash(strip, 'green', 2);
        }, 10);
    }