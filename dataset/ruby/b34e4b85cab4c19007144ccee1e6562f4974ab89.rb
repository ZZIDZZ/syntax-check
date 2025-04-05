def deal_with_valid_option(temp_tables, temp_columns, temp_column_types, res)
			if !temp_tables.empty?
				check_given_tables_validity(temp_tables)
				temp_tables.each do |t|
					res << convert_table(t)
				end
			elsif !temp_columns.keys.empty?
				check_given_columns_validity(temp_columns)
				res << convert_from_columns_hash(temp_columns)
			elsif !temp_column_types.empty?
				check_given_columns_validity(temp_column_types)
				res << convert_from_column_types_hash(temp_column_types)
			end
		end