def perform(script)
      export_variables = @params.reverse_merge("PARADUCT_JOB_ID" => @job_id, "PARADUCT_JOB_NAME" => job_name)
      variable_string = export_variables.map { |key, value| %(export #{key}="#{value}";) }.join(" ")

      Array.wrap(script).inject("") do |stdout, command|
        stdout << run_command("#{variable_string} #{command}")
        stdout
      end
    end