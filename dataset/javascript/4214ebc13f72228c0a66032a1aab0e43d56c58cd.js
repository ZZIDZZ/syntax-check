function showNumber(addr, num, decimalplaces, mindigits, leftjustified, pos, dontclear) { 

	    if(addr<0 || addr>=maxDevices)
			throw 'address out of range';
		
		num = formatNumber(num, decimalplaces, mindigits); 
	
		// internally, pos is 0 on the right, so we set defaults, and convert
		if(typeof pos === 'undefined') { 
			if(leftjustified) { 
				pos = 7; 
			} else { 
				pos = 0; 
			}
		} else pos = 7-pos; 
		
		// get rid of the decimal place but remember where it was
		var decimalplace; 
		if(num.indexOf('.')<0) decimalplace = -1; 
		else {
			decimalplace = num.length - num.indexOf('.') -1; 
			num = num.split('.').join('');
		}
		if(leftjustified) { 
			pos-=(num.length-1); 
		}
	
		for(var i = 0; i<8; i++) { 
			var offset = i+pos; 
			var char = num.charAt(num.length-1-i); 
			
			if((offset<8 && offset>=0) && (!dontclear || char!='')) 
			{
				if(char=='-') setChar(addr, offset, char, i>0 && i==decimalplace); 
				else setDigit(addr, offset, parseInt(char), i>0 && i==decimalplace); 
			}
		}
	
	}