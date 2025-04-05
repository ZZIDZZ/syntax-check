function(name, func, pluginName) {
					if(pluginName !== undefined) {
						currentPluginName = pluginName;
					}
					var eventCurrentPluginName = currentPluginName,
						//	Create an event we can bind and register
						myEventFunc = function() {
							var pubsubCore = pubsub.getCore();
							currentPluginName = eventCurrentPluginName;
							func.apply((pubsubCore? pubsubCore(): pubsub), arguments);
						};
					//	Register the plugin events and bind using pubsub
					pluginBindings[this.pluginName] = pluginBindings[this.pluginName] || [];
					pluginBindings[this.pluginName].push({ name: name, func: myEventFunc });
					pubsub.on(name, myEventFunc);
				}