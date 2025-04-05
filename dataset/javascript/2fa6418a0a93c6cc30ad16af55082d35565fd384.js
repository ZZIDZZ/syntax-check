function(callback) {
	// perform all the cleanup and other operations needed prior to shutdown,
	// but do not actually shutdown. Call the callback function only when
	// these operations are actually complete.
	try {
    TacitServer.app_server.close();
		console.log(TacitServer.configs.server_prefix + " - Shutdown app successful.");
	}
	catch(ex) {
		console.log(TacitServer.configs.server_prefix + " - Shutdown app failed.");
		console.log(ex);
	}
	try {
    TacitServer.api_server.close();
		console.log(TacitServer.configs.server_prefix + " - Shutdown api successful.");
	}
	catch(ex) {
		console.log(TacitServer.configs.server_prefix + " - Shutdown api failed.");
		console.log(ex);
	}
	console.log(TacitServer.configs.server_prefix + " - All preparations for shutdown completed.");
	callback();
}