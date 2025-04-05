def register_hooks(app):
    """Register hooks."""

    @app.before_request
    def before_request():
        g.user = get_current_user()
        if g.user and g.user.is_admin:
            g._before_request_time = time.time()

    @app.after_request
    def after_request(response):
        if hasattr(g, '_before_request_time'):
            delta = time.time() - g._before_request_time
            response.headers['X-Render-Time'] = delta * 1000
        return response