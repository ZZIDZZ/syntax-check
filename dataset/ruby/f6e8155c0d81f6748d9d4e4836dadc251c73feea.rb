def repack temp=:file
			case temp
			when :file
				Tempfile.open 'ole-repack' do |io|
					io.binmode
					repack_using_io io
				end
			when :mem;  StringIO.open(''.dup, &method(:repack_using_io))
			else raise ArgumentError, "unknown temp backing #{temp.inspect}"
			end
		end