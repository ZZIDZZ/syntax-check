def get_stylesheet_resources(self):
		"Get the stylesheets for this instance"
		# allow css to include class variables
		class_vars = class_dict(self)
		loader = functools.partial(
			self.load_resource_stylesheet,
			subs=class_vars)
		sheets = list(map(loader, self.stylesheet_names))
		return sheets