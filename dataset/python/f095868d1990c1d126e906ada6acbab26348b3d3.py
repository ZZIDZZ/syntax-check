def register_link(self, link):
        """
        source record and index must have been set
        """
        keys = tuple((ref, link.initial_hook_value) for ref in link.hook_references)

        # look for a record hook
        for k in keys:
            if k in self._record_hooks:
                # set link target
                link.set_target(target_record=self._record_hooks[k].target_record)
                break
        else:
            # look for a table hook
            for k in keys:
                if k in self._table_hooks:
                    # set link target
                    link.set_target(target_table=self._table_hooks[k])
                    break
            else:
                field_descriptor = link.source_record.get_field_descriptor(link.source_index)
                raise FieldValidationError(
                    f"No object found with any of given references : {keys}. "
                    f"{field_descriptor.get_error_location_message(link.initial_hook_value)}"
                )

        # store by source
        if link.source_record not in self._links_by_source:
            self._links_by_source[link.source_record] = set()
        self._links_by_source[link.source_record].add(link)

        # store by target
        if link.target not in self._links_by_target:
            self._links_by_target[link.target] = set()
        self._links_by_target[link.target].add(link)