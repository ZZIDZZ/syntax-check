def search(self, query, verbose=0):
        """Searches files satisfying query

        It first decompose the query in ngrams, then score each document containing
        at least one ngram with the number. The ten document having the most ngrams
        in common with the query are selected.
        
        Args:
             query (str): what to search;
             results_number (int): number of results to return (default: 10)
        """
        if verbose > 0:
            print("searching " + query)
        query = query.lower()
        qgram = ng(query, self.slb)
        qocument = set()
        for q in qgram:
            if q in self.ngrams.keys():
                for i in self.ngrams[q]:
                    qocument.add(i)
        self.qocument = qocument
        results = {}
        for i in qocument:
           for j in self.D[i].keys():
                if not j in results.keys():
                    results[j] = 0
                results[j] = results[j] + self.D[i][j]
        sorted_results = sorted(results.items(), key=operator.itemgetter(1), reverse=True)
        return [self.elements[f[0]] for f in sorted_results]