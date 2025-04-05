def fetch_sqlite_master(self):
        """
        Get sqlite_master table information as a list of dictionaries.

        :return: sqlite_master table information.
        :rtype: list

        :Sample Code:
            .. code:: python

                from sqliteschema import SQLiteSchemaExtractor

                print(json.dumps(SQLiteSchemaExtractor("sample.sqlite").fetch_sqlite_master(), indent=4))

        :Output:
            .. code-block:: json

                [
                    {
                        "tbl_name": "sample_table",
                        "sql": "CREATE TABLE 'sample_table' ('a' INTEGER, 'b' REAL, 'c' TEXT, 'd' REAL, 'e' TEXT)",
                        "type": "table",
                        "name": "sample_table",
                        "rootpage": 2
                    },
                    {
                        "tbl_name": "sample_table",
                        "sql": "CREATE INDEX sample_table_a_index ON sample_table('a')",
                        "type": "index",
                        "name": "sample_table_a_index",
                        "rootpage": 3
                    }
                ]
        """

        sqlite_master_record_list = []
        result = self.__cur.execute(
            "SELECT {:s} FROM sqlite_master".format(", ".join(self._SQLITE_MASTER_ATTR_NAME_LIST))
        )

        for record in result.fetchall():
            sqlite_master_record_list.append(
                dict(
                    [
                        [attr_name, item]
                        for attr_name, item in zip(self._SQLITE_MASTER_ATTR_NAME_LIST, record)
                    ]
                )
            )

        return sqlite_master_record_list