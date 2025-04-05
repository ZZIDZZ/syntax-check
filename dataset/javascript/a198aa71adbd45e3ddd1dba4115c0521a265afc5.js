function(event, listener){
        switch (event) {
            case "log":
                bus.subscribe(EVENT_BUSLINE, {
                    onRemoteLogReceived: function(logObj){
                        listener(logObj);
                    }
                });
                break;
            default: console.error("[LOGIA] Unknown event name: '" + event + "'");
        }
    }