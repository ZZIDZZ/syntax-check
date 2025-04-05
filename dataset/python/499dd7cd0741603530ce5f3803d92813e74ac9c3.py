def op_or(self, *elements):
        """Update the ``Expression`` by joining the specified additional
        ``elements`` using an "OR" ``Operator``

        Args:
            *elements (BaseExpression): The ``Expression`` and/or
                ``Constraint`` elements which the "OR" ``Operator`` applies
                to.

        Returns:
            Expression: ``self`` or related ``Expression``.
        """
        expression = self.add_operator(Operator(','))
        for element in elements:
            expression.add_element(element)
        return expression