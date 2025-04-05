def [] file, *ps, &exe
			opts = ::Hash === ps.last ? ps.pop : {}
			opts[:env] = self
			name, type, flg = ps[0] || opts[:name], ps[1] || opts[:type], ps[2] || opts[:flags]
			ps.push opts
			@dbs[ [file, name, flg | CREATE]] ||= (type || SBDB::Unknown).new file, *ps, &exe
		end