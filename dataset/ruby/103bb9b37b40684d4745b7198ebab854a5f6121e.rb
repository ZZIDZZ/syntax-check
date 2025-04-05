def has_machete_workflow_of(jobs_active_record_relation_symbol)
      # yes, this is magic mimicked from http://guides.rubyonrails.org/plugins.html
      #  and http://yehudakatz.com/2009/11/12/better-ruby-idioms/
      cattr_accessor :jobs_active_record_relation_symbol
      self.jobs_active_record_relation_symbol = jobs_active_record_relation_symbol

      # separate modules to group common methods for readability purposes
      # both builder methods and status methods need the jobs relation so
      # we include that first
      self.send :include, OscMacheteRails::Workflow::JobsRelation
      self.send :include, OscMacheteRails::Workflow::BuilderMethods
      self.send :include, OscMacheteRails::Workflow::StatusMethods
    end