def djfrontend_ga(account=None):
    """
    Returns Google Analytics asynchronous snippet.
    Use DJFRONTEND_GA_SETDOMAINNAME to set domain for multiple, or cross-domain tracking.
    Set DJFRONTEND_GA_SETALLOWLINKER to use _setAllowLinker method on target site for cross-domain tracking.
    Included in HTML5 Boilerplate.
    """
    if account is None:
        account = getattr(settings, 'DJFRONTEND_GA', False)

    if account:
        if getattr(settings, 'TEMPLATE_DEBUG', False):
            return ''
        else:
            if getattr(settings, 'DJFRONTEND_GA_SETDOMAINNAME', False):
                if getattr(settings, 'DJFRONTEND_GA_SETALLOWLINKER', False):
                    return mark_safe(
                        '<script>(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("require", "linker");ga("linker:autoLink", ["%s"]);ga("create", "%s", "auto", {"allowLinker": true});ga("send", "pageview");</script>' %
                        (settings.DJFRONTEND_GA_SETDOMAINNAME, account))
                else:
                    return mark_safe(
                        '<script>(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create", "%s", "%s");ga("send", "pageview");</script>' %
                        (account, settings.DJFRONTEND_GA_SETDOMAINNAME))
            else:
                return mark_safe(
                    '<script>(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create", "%s", "auto");ga("send", "pageview");</script>' % account)
    else:
        return ''