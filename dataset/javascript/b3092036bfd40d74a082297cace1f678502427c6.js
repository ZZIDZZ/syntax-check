function mapToService () {
  return ({ request, requestMapper, mappings }) => {
    const data = mapData(request.data, request, mappings)
    return {
      ...request,
      data: applyEndpointMapper(data, request, requestMapper)
    }
  }
}