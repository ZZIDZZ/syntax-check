def iter_hierarchy(self, ontology, size=None, sleep=None):
        """Iterates over parent-child relations

        :param str ontology: The name of the ontology
        :param int size: The size of each page. Defaults to 500, which is the maximum allowed by the EBI.
        :param int sleep: The amount of time to sleep between pages. Defaults to 0 seconds.
        :rtype: iter[tuple[str,str]]
        """
        for term in self.iter_terms(ontology=ontology, size=size, sleep=sleep):
            try:
                hierarchy_children_link = term['_links'][HIERARCHICAL_CHILDREN]['href']
            except KeyError:  # there's no children for this one
                continue

            response = requests.get(hierarchy_children_link).json()

            for child_term in response['_embedded']['terms']:
                yield term['label'], child_term['label']