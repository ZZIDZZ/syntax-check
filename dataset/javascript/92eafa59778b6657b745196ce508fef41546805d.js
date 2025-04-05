function sortImages(){
		var arr = [];
		/**
		 * Create a double loop
		 * And match the order of the srcs array
		 */
		for (var i = 0; i < srcs.length; i++) {
			for (var j = 0; j < imgs.length; j++) {
				var str = imgs[j].src.toString();
				var reg = new RegExp(srcs[i])
				/** If srcs matches the imgs add it the the new array */
				if(str.match(reg)) arr.push(imgs[j]);
			};
		};

		/** Override imgs array with the new sorted arr */
		imgs = arr;
	}