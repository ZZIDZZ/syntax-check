function(element, ev, fn){
	if(element.addEventListener) 
		element.addEventListener(ev, fn, false);
	else element.attachEvent("on" + ev, fn);
}