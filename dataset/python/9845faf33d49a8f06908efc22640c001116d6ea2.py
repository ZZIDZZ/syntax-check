def delete_report(self, report):
        """
        Deletes a generated report instance.

        https://canvas.instructure.com/doc/api/account_reports.html#method.account_reports.destroy
        """
        url = ACCOUNTS_API.format(report.account_id) + "/reports/{}/{}".format(
            report.type, report.report_id)

        response = self._delete_resource(url)
        return True