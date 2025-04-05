function(opts) {
	if (!opts.multiclassClassifierType) {
		console.dir(opts);
		throw new Error("opts.multiclassClassifierType not found");
	}
	this.multiclassClassifierType = opts.multiclassClassifierType;
	this.featureExtractor = FeaturesUnit.normalize(opts.featureExtractor);
	
	this.multiclassClassifier = new this.multiclassClassifierType();
}