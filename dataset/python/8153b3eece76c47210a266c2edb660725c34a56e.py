def render_hero_slider(context):
    """
    Renders the hero slider.

    """
    req = context.get('request')
    qs = SliderItem.objects.published(req).order_by('position')
    return {
        'slider_items': qs,
    }