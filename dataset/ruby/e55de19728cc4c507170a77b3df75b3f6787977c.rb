def decrement

      c = data['count']
      return false unless c

      c = c - 1
      data['count'] = c
      self[:status] = s = (c > 0) ? 'active' : 'consumed'

      self.update(
        content: Flor::Storage.to_blob(@flor_model_cache_data),
        status: s)

      c < 1
    end