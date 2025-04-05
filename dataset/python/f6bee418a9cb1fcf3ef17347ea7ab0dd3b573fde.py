def map_exact2foreign_invoice_numbers(self, exact_invoice_numbers=None):
        """
        Optionally supply a list of ExactOnline invoice numbers.

        Returns a dictionary of ExactOnline invoice numbers to foreign
        (YourRef) invoice numbers.
        """
        # Quick, select all. Not the most nice to the server though.
        if exact_invoice_numbers is None:
            ret = self.filter(select='InvoiceNumber,YourRef')
            return dict((i['InvoiceNumber'], i['YourRef']) for i in ret)

        # Slower, select what we want to know. More work for us.
        exact_to_foreign_map = {}

        # Do it in batches. If we append 300 InvoiceNumbers at once, we
        # get a 12kB URI. (If the list is empty, we skip the entire
        # forloop and correctly return the empty dict.)
        exact_invoice_numbers = list(set(exact_invoice_numbers))  # unique
        for offset in range(0, len(exact_invoice_numbers), 40):
            batch = exact_invoice_numbers[offset:(offset + 40)]
            filter_ = ' or '.join(
                'InvoiceNumber eq %s' % (i,) for i in batch)
            assert filter_  # if filter was empty, we'd get all!
            ret = self.filter(filter=filter_, select='InvoiceNumber,YourRef')
            exact_to_foreign_map.update(
                dict((i['InvoiceNumber'], i['YourRef']) for i in ret))

        # Any values we missed?
        for exact_invoice_number in exact_invoice_numbers:
            if exact_invoice_number not in exact_to_foreign_map:
                exact_to_foreign_map[exact_invoice_number] = None

        return exact_to_foreign_map