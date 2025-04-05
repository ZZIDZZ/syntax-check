def uninstall():
    """
    Uninstall tasks from cron.
    """
    tab = crontab.CronTab(user=True)
    count = len(list(tab.find_comment(KRONOS_BREADCRUMB)))
    tab.remove_all(comment=KRONOS_BREADCRUMB)
    tab.write()
    return count