def get_list_display(self, request):
        """
        Return a sequence containing the fields to be displayed on the
        changelist.
        """
        list_display = []
        for field_name in self.list_display:
            try:
                db_field = self.model._meta.get_field(field_name)
                if isinstance(db_field, BooleanField):
                    field_name = boolean_switch_field(db_field)
            except FieldDoesNotExist:
                pass
            list_display.append(field_name)
        return list_display