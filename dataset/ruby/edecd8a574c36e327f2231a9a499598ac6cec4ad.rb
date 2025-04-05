def site_query(*args)
      response = conn.get(url_picker(*args), {}, query_headers)

      if response.body['SiteId'] || response.body['PointId']
        JSON.parse(response.body)
      else
        fail QueryError, "Query Failed! HTTPStatus: #{response.status}"
      end
    end