def token_count_pandas(self):
        """ See token counts as pandas dataframe"""
        freq_df = pd.DataFrame.from_dict(self.indexer.word_counts, orient='index')
        freq_df.columns = ['count']
        return freq_df.sort_values('count', ascending=False)