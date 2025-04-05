function(Vue){
		var __self = this;
		Vue.prototype.$snackbar = {};
	  	Vue.prototype.$snackbar.create = function(data, options, callback){
	  		__self.create(data, options, callback);
	  	};
	}