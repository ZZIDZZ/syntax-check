function(cssScreen, cssHandheld, mobileMaxWidth) {
			// Set config values
			if (typeof(cssScreen) != "undefined") {
				config.cssScreen = cssScreen;	
			}
			if (typeof(cssHandheld) != "undefined") {
				config.cssHandheld = cssHandheld;	
			}
			if (typeof(mobileMaxWidth) != "undefined") {
				config.mobileMaxWidth = mobileMaxWidth;	
			}
			
			// Check if CSS is loaded
			var cssloadCheckNode = document.createElement('div');
			cssloadCheckNode.className = config.testDivClass;
			document.getElementsByTagName("body")[0].appendChild(cssloadCheckNode);
			if (cssloadCheckNode.offsetWidth != 100 && noMediaQuery == false) {
				noMediaQuery = true;
			}
			cssloadCheckNode.parentNode.removeChild(cssloadCheckNode)
			
			if (noMediaQuery == true) {
				// Browser does not support Media Queries, so JavaScript will supply a fallback 
				var cssHref = "";
				
				// Determines what CSS file to load
				if (getWindowWidth() <= config.mobileMaxWidth) {
					cssHref = config.cssHandheld;
					newCssMediaType = "handheld";
				} else {
					cssHref = config.cssScreen;
					newCssMediaType = "screen";
				}
				
				// Add CSS link to <head> of page
				if (cssHref != "" && currentCssMediaType != newCssMediaType) {
					var currentCssLinks = document.styleSheets
					for (var i = 0; i < currentCssLinks.length; i++) {
						for (var ii = 0; ii < currentCssLinks[i].media.length; ii++) {
							if (typeof(currentCssLinks[i].media) == "object") {
								if (currentCssLinks[i].media.item(ii) == "fallback") {
									currentCssLinks[i].ownerNode.parentNode.removeChild(currentCssLinks[i].ownerNode)
									i--
									break;
								}
							} else {
								if (currentCssLinks[i].media.indexOf("fallback") >= 0) {
									currentCssLinks[i].owningElement.parentNode.removeChild(currentCssLinks[i].owningElement)
									i--
									break;
								}
							}
						}
					}
					if (typeof(cssHref) == "object") {
						for (var i = 0; i < cssHref.length; i++) {
							addCssLink(cssHref[i])
						}
					} else {
						addCssLink(cssHref)
					}
										
					currentCssMediaType = newCssMediaType;
				}

				
				// Check screen size again if user resizes window 
				addEvent(window, wbos.CssTools.MediaQueryFallBack.LoadCssDelayed, 'onresize')
			}
		}