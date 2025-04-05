def pack_value(val, obj=nil)
        begin
          if @pack_cb
            @pack_cb.call(val, obj)
          else
            varray = val.is_a?(Array) ? val : [val]
            varray.pack(self.format)
          end
        rescue => e
          raise(PackError, "Error packing #{val.inspect} as type #{self.name.inspect} -- #{e.class} -> #{e}")
        end
      end