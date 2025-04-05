def find(self, *args, **kwargs):
        """
        Find a single Node among this Node's descendants.

        Returns :class:`NullNode` if nothing matches.

        This inputs to this function follow the same semantics
        as BeautifulSoup. See http://bit.ly/bs4doc for more info.

        Examples:

         - node.find('a')  # look for `a` tags
         - node.find('a', 'foo') # look for `a` tags with class=`foo`
         - node.find(func) # find tag where func(tag) is True
         - node.find(val=3)  # look for tag like <a, val=3>
        """
        op = operator.methodcaller('find', *args, **kwargs)
        return self._wrap_node(op)