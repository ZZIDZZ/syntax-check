def monitor(reference)
      obj = reference.object
      if obj
        @lock.synchronize do
          @references[reference.referenced_object_id] = reference
        end
        ObjectSpace.define_finalizer(obj, @finalizer)
      else
        push(reference)
      end
    end