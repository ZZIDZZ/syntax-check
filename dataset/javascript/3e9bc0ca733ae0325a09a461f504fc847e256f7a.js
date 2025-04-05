function() {
		var code = "";

		// Collect object initializers
		for (var i=0, l=this.index.length; i<l; ++i) {
			var o = this.index[i];
			code += "/**\n * Property getter "+o.name+"\n */\n";
			code += "function getter_"+o.safeName+"(inst) {\n";
			code += this.indent + "return "+o.generatePropertyGetter('inst',this.indent+this.indent) + ";\n";
			code += "}\n\n";
		}

		code += "\n"
		return code;
	}