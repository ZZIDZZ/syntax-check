def join(collection, glue = nil, &it)
      # TODO as helper? two block method call #join(collection, &item).with(&glue)
      glue_block = case glue
                     when String
                       lambda { text glue }
                     when Proc
                       glue
                     else
                       lambda {}
                   end

      collection.each_with_index do |obj, i|
        glue_block.call() if i > 0
        obj.is_a?(Proc) ? obj.call : it.call(obj)
      end
    end