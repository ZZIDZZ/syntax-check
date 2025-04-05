def _split_model_kwargs_association(self, data):
        """Split serialized attrs to ensure association proxies are passed separately.

        This is necessary for Python < 3.6.0, as the order in which kwargs are passed
        is non-deterministic, and associations must be parsed by sqlalchemy after their
        intermediate relationship, unless their `creator` has been set.

        Ignore invalid keys at this point - behaviour for unknowns should be
        handled elsewhere.

        :param data: serialized dictionary of attrs to split on association_proxy.
        """
        association_attrs = {
            key: value
            for key, value in iteritems(data)
            # association proxy
            if hasattr(getattr(self.opts.model, key, None), "remote_attr")
        }
        kwargs = {
            key: value
            for key, value in iteritems(data)
            if (hasattr(self.opts.model, key) and key not in association_attrs)
        }
        return kwargs, association_attrs