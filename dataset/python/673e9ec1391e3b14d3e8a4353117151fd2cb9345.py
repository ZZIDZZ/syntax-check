def run(self):
        """run enrichr for one sample gene list but multi-libraries"""

        # set organism
        self.get_organism()
        # read input file
        genes_list = self.parse_genelists()
        gss = self.parse_genesets()
        # if gmt
        self._logger.info("Connecting to Enrichr Server to get latest library names")
        if len(gss) < 1:
            sys.stderr.write("Not validated Enrichr library name provided\n")
            sys.stdout.write("Hint: use get_library_name() to view full list of supported names")
            sys.exit(1)
        self.results = pd.DataFrame()

        for g in gss: 
            if isinstance(g, dict): 
                ## local mode
                res = self.enrich(g)
                shortID, self._gs = str(id(g)), "CUSTOM%s"%id(g)
                if res is None: 
                    self._logger.info("No hits return, for gene set: Custom%s"%shortID)
                    continue
            else:
                ## online mode
                self._gs = str(g)
                self._logger.debug("Start Enrichr using library: %s" % (self._gs))
                self._logger.info('Analysis name: %s, Enrichr Library: %s' % (self.descriptions, self._gs))
                shortID, res = self.get_results(genes_list)
                # Remember gene set library used
            res.insert(0, "Gene_set", self._gs)
            # Append to master dataframe
            self.results = self.results.append(res, ignore_index=True, sort=True)
            self.res2d = res
            if self._outdir is None: continue
            self._logger.info('Save file of enrichment results: Job Id:' + str(shortID))
            outfile = "%s/%s.%s.%s.reports.txt" % (self.outdir, self._gs, self.descriptions, self.module)
            self.res2d.to_csv(outfile, index=False, encoding='utf-8', sep="\t")
            # plotting
            if not self.__no_plot:
                msg = barplot(df=res, cutoff=self.cutoff, figsize=self.figsize,
                              top_term=self.__top_term, color='salmon',
                              title=self._gs,
                              ofname=outfile.replace("txt", self.format))
                if msg is not None : self._logger.warning(msg)
            self._logger.info('Done.\n')
        # clean up tmpdir
        if self._outdir is None: self._tmpdir.cleanup()

        return