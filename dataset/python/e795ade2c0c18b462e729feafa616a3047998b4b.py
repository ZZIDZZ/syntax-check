def render(self, name, value, attrs=None):
        u"""Render CodeMirrorTextarea"""
        if self.js_var_format is not None:
            js_var_bit = 'var %s = ' % (self.js_var_format % name)
        else:
            js_var_bit = ''
        output = [super(CodeMirrorTextarea, self).render(name, value, attrs),
            '<script type="text/javascript">%sCodeMirror.fromTextArea(document.getElementById(%s), %s);</script>' %
                (js_var_bit, '"id_%s"' % name, self.option_json)]
        return mark_safe('\n'.join(output))