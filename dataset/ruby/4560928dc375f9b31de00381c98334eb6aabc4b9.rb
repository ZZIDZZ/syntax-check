def relevant_rules(action, subject)
      rules.reverse.select do |rule|
        rule.expanded_actions = expand_actions(rule.actions)
        rule.relevant? action, subject
      end
    end