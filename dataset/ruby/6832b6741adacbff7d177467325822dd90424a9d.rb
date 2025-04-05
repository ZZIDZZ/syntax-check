def get_userinfo(user)
      p = {}
      ids = []
      names = []

      if user.is_a?(Array)
        user.each do |u|
          names << u if u.is_a?(String)
          id << u if u.is_a?(Integer)
        end
      elsif user.is_a?(String)
        names << user
      elsif user.is_a?(Integer)
        ids << user
      else
        raise ArgumentError, format('Unknown type of arguments: %s', user.class)
      end

      result = get('ids' => ids, 'names' => names)

      result['users']
    end