def as_sql(self, compiler, connection) -> Tuple[str, List[Any]]:
        """Compiles this JOIN into a SQL string."""

        sql, params = super().as_sql(compiler, connection)
        qn = compiler.quote_name_unless_alias

        # generate the extra conditions
        extra_conditions = ' AND '.join([
            '{}.{} = %s'.format(
                qn(self.table_name),
                qn(field.column)
            )
            for field, value in self.extra_conditions
        ])

        # add to the existing params, so the connector will
        # actually nicely format the value for us
        for _, value in self.extra_conditions:
            params.append(value)

        # rewrite the sql to include the extra conditions
        rewritten_sql = sql.replace(')', ' AND {})'.format(extra_conditions))
        return rewritten_sql, params