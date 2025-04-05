def run_report_request(report_name, report_params = {}, page_size = 50)
      response = request 'runReportRequest' do |xml|
        xml.reportName report_name
        report_params.each do |name, value|
          xml.reportParam do
            xml.paramName name
            xml.paramValue value
          end
        end
        xml.pageSize page_size
      end

      response.elements["runReportResponse/reportId"].get_text.value
    end