def write_to_file(self):
        """
        Writes the weeks with associated commits to file.
        """
        with open('../github_stats_output/last_year_commits.csv', 'w+') as output:
            output.write('date,organization,repos,members,teams,'
                + 'unique_contributors,total_contributors,forks,'
                + 'stargazers,pull_requests,open_issues,has_readme,'
                + 'has_license,pull_requests_open,pull_requests_closed,'
                + 'commits\n')
            #no reverse this time to print oldest first
            previous_commits = 0
            for week in self.sorted_weeks:
                if str(self.commits[week]) != previous_commits:#delete dups
                    week_formatted = datetime.datetime.utcfromtimestamp(
                        week ).strftime('%Y-%m-%d')
                    output.write(week_formatted
                        + ',llnl,0,0,0,0,0,0,0,0,0,0,0,0,0,'
                        + str(self.commits[week]) + '\n')
                    previous_commits = str(self.commits[week])