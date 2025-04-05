def render(self, name, value, attrs=None):
        """Include a hidden input to stored the serialized upload value."""
        context = attrs or {}
        context.update({'name': name, 'value': value, })
        return render_to_string(self.template_name, context)