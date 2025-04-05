def get_context_data(self, **kwargs):
        """
        Get the context for this view.
        """
        #max_columns, max_rows = self.get_max_dimension()
        context = {
            'gadgets': self._registry,
            'columns': self.columns,
            'rows': self.rows,
            'column_ratio': 100 - self.columns * 2,
            'row_ratio': 100 - self.rows * 2,
        }
        context.update(kwargs)
        return context