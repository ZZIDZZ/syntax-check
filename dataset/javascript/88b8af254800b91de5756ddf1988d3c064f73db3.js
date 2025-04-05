function Image(image, address){

	var at = this.attributes = image.attribs;

	this.name = path.basename(at.src, path.extname(at.src));
	this.saveTo = path.dirname(require.main.filename) + "/";
	this.extension = path.extname(at.src);
	this.address = url.resolve(address, at.src);
	this.fromAddress = address;
}