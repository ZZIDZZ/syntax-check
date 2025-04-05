def check_for_upgrade
      if plan_id_changed?
        old_plan = Plan.find(plan_id_was) if plan_id_was.present?
        self.upgraded = true if old_plan.nil? || old_plan.order < plan.order
      end
    end