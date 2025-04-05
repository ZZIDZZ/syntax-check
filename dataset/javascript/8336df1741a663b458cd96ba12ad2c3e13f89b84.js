function exec() {
		var flow = typeof exports != 'undefined' ? exports : window.flow;
		applyArgs(flow.define, flow, arguments)();
	}