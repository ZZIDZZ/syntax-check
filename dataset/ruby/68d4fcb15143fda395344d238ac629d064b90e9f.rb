def reporter(query, options={}, &block)
      @report ||= QueryReport::Report.new(params, view_context, options)
      @report.query = query
      @report.instance_eval &block
      render_report(options) unless options[:skip_rendering]
      @report
    end