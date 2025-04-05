def compute_return(self, start_date, end_date, rate="MID"):
        """
        Compute the return of the currency between two dates
        """
        if rate not in ["MID", "ASK", "BID"]:
            raise ValueError("Unknown rate type (%s)- must be 'MID', 'ASK' or 'BID'" % str(rate))

        if end_date <= start_date:
            raise ValueError("End date must be on or after start date")

        df = self.generate_dataframe(start_date=start_date, end_date=end_date)
        start_price = df.ix[start_date][rate]
        end_price = df.ix[end_date][rate]

        currency_return = (end_price / start_price) - 1.0

        return currency_return