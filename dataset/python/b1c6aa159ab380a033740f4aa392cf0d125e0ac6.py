def post_call(self, ctxt, result, action, post_mod, pre_mod):
        """
        A modifier hook function.  This is called in reverse-priority
        order after invoking the ``Action`` for the step.  This allows
        a modifier to inspect or alter the result of the step.

        :param ctxt: The context object.
        :param result: The result of the action.  This will be a
                       ``StepResult`` object.
        :param action: The action that was performed.
        :param post_mod: A list of modifiers following this modifier
                         in the list of modifiers that is applicable
                         to the action.  This list is in priority
                         order.
        :param pre_mod: A list of modifiers preceding this modifier in
                        the list of modifiers that is applicable to
                        the action.  This list is in priority order.

        :returns: The result for the action, optionally modified.  If
                  the result is not modified, ``result`` must be
                  returned unchanged.  This implementation alters the
                  ``ignore`` property of the ``result`` object to
                  match the configured value.
        """

        # Set the ignore state
        result.ignore = self.config

        return result