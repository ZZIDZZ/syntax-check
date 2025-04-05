def within
      unless block_given?
        raise 'No block provided'
      end

      unless begin?
        raise "Illegal state for within: #{state}"
      end

      adapters = @adapters

      adapters.each_key do |adapter|
        adapter.push_transaction(self)
      end

      begin
        yield self
      ensure
        adapters.each_key do |adapter|
          adapter.pop_transaction
        end
      end
    end