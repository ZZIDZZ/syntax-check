function Bitmap(imageOrUri) {
		this.DisplayObject_constructor();
		
		
	// public properties:
		/**
		 * The source image to display. This can be a CanvasImageSource
		 * (image, video, canvas), an object with a `getImage` method that returns a CanvasImageSource, or a string URL to an image.
		 * If the latter, a new Image instance with the URL as its src will be used.
		 * @property image
		 * @type CanvasImageSource | Object
		 **/
		if (typeof imageOrUri == "string") {
			this.image = document.createElement("img");
			this.image.src = imageOrUri;
		} else {
			this.image = imageOrUri;
		}
	
		/**
		 * Specifies an area of the source image to draw. If omitted, the whole image will be drawn.
		 * Note that video sources must have a width / height set to work correctly with `sourceRect`.
		 * @property sourceRect
		 * @type Rectangle
		 * @default null
		 */
		this.sourceRect = null;

	// private properties:
		/**
		 * Docced in superclass.
		 */
		this._webGLRenderStyle = createjs.DisplayObject._StageGL_BITMAP;
	}