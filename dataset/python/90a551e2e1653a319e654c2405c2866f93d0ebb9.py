def generate_hpo_gene_list(self, *hpo_terms):
        """Generate a sorted list with namedtuples of hpogenes

            Each namedtuple of the list looks like (hgnc_id, count)

            Args:
                hpo_terms(iterable(str))

            Returns:
                hpo_genes(list(HpoGene))
        """
        genes = {}
        for term in hpo_terms:
            hpo_obj = self.hpo_term(term)
            if hpo_obj:
                for hgnc_id in hpo_obj['genes']:
                    if hgnc_id in genes:
                        genes[hgnc_id] += 1
                    else:
                        genes[hgnc_id] = 1
            else:
                LOG.warning("Term %s could not be found", term)

        sorted_genes = sorted(genes.items(), key=operator.itemgetter(1), reverse=True)
        return sorted_genes