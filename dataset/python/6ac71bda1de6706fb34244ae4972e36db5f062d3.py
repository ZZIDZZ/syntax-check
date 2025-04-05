def wrapHeart(service):
    """Wrap a service in a MultiService with a heart"""
    master = taservice.MultiService()
    service.setServiceParent(master)
    maybeAddHeart(master)
    return master