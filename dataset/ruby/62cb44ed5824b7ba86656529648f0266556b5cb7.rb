def present(object, presenter: nil, **args)
      if object.respond_to?(:to_ary)
        object.map { |item| present(item, presenter: presenter, **args) }
      else
        presenter ||= presenter_klass(object)
        wrapper = presenter.new(object, view_context, **args)
        block_given? ? yield(wrapper) : wrapper
      end
    end