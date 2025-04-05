def get_signals
      all_signals = []
      current = @klass
      while current != Qt::Base
        meta = Meta[current.name]
        if !meta.nil?
          all_signals.concat meta.signals
        end
        current = current.superclass
      end
      return all_signals
    end