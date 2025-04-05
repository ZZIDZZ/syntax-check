def read args = {}
      if args.class == Hash
        hash = @options.merge(args)
      else
        puts "dreader error at #{__callee__}: this function takes a Hash as input"
        exit
      end

      spreadsheet = Dreader::Engine.open_spreadsheet (hash[:filename])
      sheet = spreadsheet.sheet(hash[:sheet] || 0)

      @table = Array.new
      @errors = Array.new

      first_row = hash[:first_row] || 1
      last_row = hash[:last_row] || sheet.last_row

      (first_row..last_row).each do |row_number|
        r = Hash.new
        @colspec.each_with_index do |colspec, index|
          cell = sheet.cell(row_number, colspec[:colref])
          
          colname = colspec[:name]

          r[colname] = Hash.new
          r[colname][:row_number] = row_number
          r[colname][:col_number] = colspec[:colref]

          begin
            r[colname][:value] = value = colspec[:process] ? colspec[:process].call(cell) : cell
          rescue => e
            puts "dreader error at #{__callee__}: 'process' specification for :#{colname} raised an exception at row #{row_number} (col #{index + 1}, value: #{cell})"
            raise e
          end

          begin
            if colspec[:check] and not colspec[:check].call(value) then
              r[colname][:error] = true
              @errors << "dreader error at #{__callee__}: value \"#{cell}\" for #{colname} at row #{row_number} (col #{index + 1}) does not pass the check function"
            else
              r[colname][:error] = false
            end
          rescue => e
            puts "dreader error at #{__callee__}: 'check' specification for :#{colname} raised an exception at row #{row_number} (col #{index + 1}, value: #{cell})"
            raise e
          end
        end

        @table << r
      end

      @table
    end