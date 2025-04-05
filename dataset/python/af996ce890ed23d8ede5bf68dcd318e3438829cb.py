def create_missing_task(self,
                            asana_workspace_id,
                            name,
                            assignee,
                            projects,
                            completed,
                            issue_number,
                            issue_html_url,
                            issue_state,
                            issue_body,
                            tasks,
                            labels,
                            label_tag_map):

        """Creates a missing task."""

        task = self.asana.tasks.create_in_workspace(
            asana_workspace_id,
            {
                'name': name,
                'notes': issue_body,
                'assignee': assignee,
                'projects': projects,
                'completed': completed,
            })

        # Announce task git issue
        task_id = task['id']

        put("create_story",
            task_id=task_id,
            text="Git Issue #%d: \n"
                  "%s" % (
                    issue_number,
                    issue_html_url,
                    )
            )

        put("apply_tasks_to_issue",
            tasks=[task_id],
            issue_number=issue_number,
            issue_body=issue_body,
            )

        # Save task to drive
        put_setting("save_issue_data_task",
                    issue=issue_number,
                    task_id=task_id,
                    namespace=issue_state)

        tasks.append(task_id)

        # Sync tags/labels
        put("sync_tags",
            tasks=tasks,
            labels=labels,
            label_tag_map=label_tag_map)