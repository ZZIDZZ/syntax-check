def run_strategy(name, scope)
      strategy = "Janus::Strategies::#{name.to_s.camelize}".constantize.new(scope, self)

      if strategy.valid?
        strategy.authenticate!

        if strategy.success?
          send(strategy.auth_method, strategy.user, :scope => scope)
          Janus::Manager.run_callbacks(:authenticate, strategy.user, self, :scope => scope)
        end
      end

      strategy.success?
    end