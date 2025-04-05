function timeoutCb() {
        if (!received) {
            self.emit('error', {
				type: 'socket: timeout',
				data: 'Connection problem: No response'
			});
        }
		// Websockets Node module doen't support any close function, we're using the client
		// https://github.com/Worlize/WebSocket-Node/blob/master/lib/WebSocketClient.js
		// So we need this var to "emulate" it and avoid returning multiple errors
        wsError = true;

        // We're closing the socket manually, so we need this to avoid errors
        self.close();
    }