def model_view_set(injector):
    """Create DRF model view set from injector class."""

    handler = create_handler(ModelViewSet, injector)
    apply_api_view_methods(handler, injector)
    apply_generic_api_view_methods(handler, injector)
    apply_model_view_set_methods(handler, injector)
    return injector.let(as_viewset=lambda: handler)