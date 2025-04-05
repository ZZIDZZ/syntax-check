def derived(self, name, relative_coords, formula):
        """Helper function for derived quantities"""
        relZ, relN = relative_coords
        daughter_idx = [(x[0] + relZ, x[1] + relN) for x in self.df.index]
        values = formula(self.df.values, self.df.loc[daughter_idx].values)
        return Table(df=pd.Series(values, index=self.df.index, name=name + '(' + self.name + ')'))