def persisted_with_slug_changes?
      if localized?
        changes = _slugs_change
        return (persisted? && false) if changes.nil?

        # ensure we check for changes only between the same locale
        original = changes.first.try(:fetch, I18n.locale.to_s, nil)
        compare = changes.last.try(:fetch, I18n.locale.to_s, nil)
        persisted? && original != compare
      else
        persisted? && _slugs_changed?
      end
    end