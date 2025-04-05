def view_decorator(function_decorator):
	"""Convert a function based decorator into a class based decorator usable
	on class based Views.

	Can't subclass the `View` as it breaks inheritance (super in particular),
	so we monkey-patch instead.

	Based on http://stackoverflow.com/a/8429311
	"""

	def simple_decorator(View):
		View.dispatch = method_decorator(function_decorator)(View.dispatch)
		return View

	return simple_decorator