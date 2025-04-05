function(opt) {
			
            this.disable();
			
            if (opt) this.set(opt);
			
            var jNode = new JSYG(this.node),
            dim = jNode.getDim(),
            color = jNode.fill(),
            svg = jNode.offsetParent(),
            id = 'idpattern'+JSYG.rand(0,5000),
            g,rect,selection;
													
            if (!color || color == 'transparent' || color == 'none') color = 'white';
            
            if (dim.width < this.boxInit.width) this.boxInit.width = dim.width;
            if (dim.height < this.boxInit.height) this.boxInit.height= dim.height;

			
            rect = new JSYG('<rect>').fill(color);
            g = new JSYG('<g>').append(rect);
			
            new JSYG(this.pattern)
                .attr({id:id,patternUnits:'userSpaceOnUse'})
                .append(g).appendTo(svg);
						
            new JSYG(this.mask)
                .css('fill-opacity',0.5)
                .appendTo(svg);
			
            if (this.keepRatio) this.boxInit.height = dim.height * this.boxInit.width / dim.width;
			
            selection = new JSYG(this.selection)
                .attr(this.boxInit)
                .attr('fill',"url(#"+id+")")
                .appendTo(svg);
									
            this.editor.target(selection);
            this.editor.displayShadow = false;
						
            new JSYG(this.editor.pathBox).css('fill-opacity',0);
			
            this.editor.ctrlsDrag.enable({
                bounds:0
            });
			
            this.editor.ctrlsResize.enable({
                keepRatio : this.keepRatio,
                bounds : 0
            });
			
            this.editor.show();
						
            this.enabled = true;
			
            this.update();
			
            return this;
        }