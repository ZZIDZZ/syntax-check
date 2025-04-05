def assit_block(&block)
      errors = []
      assit((block.call(errors) && errors.size == 0), errors.join(', '))
    end