def should_update(self):
        """
        Checks if an update is needed.

        Checks against ``self.update_interval`` and this widgets
        ``DashboardWidgetLastUpdate`` instance if an update is overdue.

        This should be called by
        ``DashboardWidgetPool.get_widgets_that_need_update()``, which in turn
        should be called by an admin command which should be scheduled every
        minute via crontab.

        """
        last_update = self.get_last_update()
        time_since = now() - last_update.last_update
        if time_since.seconds < self.update_interval:
            return False
        return True