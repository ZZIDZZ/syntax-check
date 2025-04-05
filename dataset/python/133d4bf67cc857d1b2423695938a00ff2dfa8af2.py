def robust_topological_sort(graph: Graph) -> list:
	"""Identify strongly connected components then perform a topological sort of those components."""
	
	assert check_argument_types()
	
	components = strongly_connected_components(graph)
	
	node_component = {}
	for component in components:
		for node in component:
			node_component[node] = component
	
	component_graph = {}
	for component in components:
		component_graph[component] = []
	
	for node in graph:
		node_c = node_component[node]
		for successor in graph[node]:
			successor_c = node_component[successor]
			if node_c != successor_c:
				component_graph[node_c].append(successor_c) 
	
	return topological_sort(component_graph)