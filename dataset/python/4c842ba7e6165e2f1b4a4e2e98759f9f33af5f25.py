def project_usls_on_dictionary(usls, allowed_terms=None):
    """`usls` is an iterable of usl.

    return a mapping term -> usl list
    """

    cells_to_usls = defaultdict(set)
    tables = set()

    for u in usls:
        for t in u.objects(Term):
            for c in t.singular_sequences:
                # This is the first time we meet the cell c
                if not cells_to_usls[c]:
                    tables.update(c.relations.contained)

                cells_to_usls[c].add(u)

    if allowed_terms:
        allowed_terms = set(allowed_terms)
        tables = tables & allowed_terms
        cells_to_usls = {c: l for c, l in cells_to_usls.items() if c in allowed_terms}

    tables_to_usls = {
        table: list(set(u for c in table.singular_sequences for u in cells_to_usls[c]))
            for table in tables if not isinstance(table, TableSet)
    }

    return tables_to_usls