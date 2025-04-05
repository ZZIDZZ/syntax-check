def render_to_standalone_html(self, request, fragment, **kwargs):  # pylint: disable=unused-argument
        """
        Render the specified fragment to HTML for a standalone page.
        """
        template = get_template(STANDALONE_TEMPLATE_NAME)
        context = {
            'head_html': fragment.head_html(),
            'body_html': fragment.body_html(),
            'foot_html': fragment.foot_html(),
        }
        return template.render(context)