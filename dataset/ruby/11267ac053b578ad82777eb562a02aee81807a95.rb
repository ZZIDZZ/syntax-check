def load
      unless valid_params?
        raise SmartAdapters::Exceptions::InvalidRequestParamsException
      end
      unless valid_format?
        raise SmartAdapters::Exceptions::InvalidRequestFormatException
      end
      adapter_finder.new(request_manager)
    end