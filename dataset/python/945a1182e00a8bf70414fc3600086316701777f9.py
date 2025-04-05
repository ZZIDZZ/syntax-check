def get_user_affinity(self, test):
        """Prepare test set for C++ SAR prediction code.
        Find all items the test users have seen in the past.

        Arguments:
            test (pySpark.DataFrame): input dataframe which contains test users.
        """
        test.createOrReplaceTempView(self.f("{prefix}df_test"))

        query = self.f(
            "SELECT DISTINCT {col_user} FROM {prefix}df_test CLUSTER BY {col_user}"
        )

        df_test_users = self.spark.sql(query)
        df_test_users.write.mode("overwrite").saveAsTable(
            self.f("{prefix}df_test_users")
        )

        query = self.f(
        """
          SELECT a.{col_user}, a.{col_item}, CAST(a.{col_rating} AS double) {col_rating}
          FROM {prefix}df_train a INNER JOIN {prefix}df_test_users b ON a.{col_user} = b.{col_user} 
          DISTRIBUTE BY {col_user}
          SORT BY {col_user}, {col_item}          
        """
        )

        return self.spark.sql(query)