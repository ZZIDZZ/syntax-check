function inlineBlockFix(decl){
    	var origRule = decl.parent;
    	origRule.append(
	    	{
	    		prop:'*display',
	    		value:'inline'
	    	},
	    	{
	    		prop:'*zoom',
	    		value:'1'
	    	}
    	);
    }