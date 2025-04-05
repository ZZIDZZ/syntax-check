def sum_totals
      @sum_totals ||= begin
        totals = Hash.new(0)

        sum_totals_by_model.each do |_, model_totals|
          model_totals.each do |stat, value|
            totals[stat] += value
          end
        end

        totals
      end
    end