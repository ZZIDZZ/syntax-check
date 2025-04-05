def __get_securities(self, currency: str, agent: str, symbol: str,
                         namespace: str) -> List[dal.Security]:
        """ Fetches the securities that match the given filters """
        repo = self.get_security_repository()
        query = repo.query

        if currency is not None:
            query = query.filter(dal.Security.currency == currency)

        if agent is not None:
            query = query.filter(dal.Security.updater == agent)

        if symbol is not None:
            query = query.filter(dal.Security.symbol == symbol)

        if namespace is not None:
            query = query.filter(dal.Security.namespace == namespace)

        # Sorting
        query = query.order_by(dal.Security.namespace, dal.Security.symbol)

        securities = query.all()
        return securities