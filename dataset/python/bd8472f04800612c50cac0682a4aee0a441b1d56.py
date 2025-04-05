def get_tasks(do_tasks, dep_graph):
    """Given a list of tasks to perform and a dependency graph, return the tasks
    that must be performed, in the correct order"""

    #XXX: Is it important that if a task has "foo" before "bar" as a dep,
    #     that foo executes before bar? Why? ATM this may not happen.

    #Each task that the user has specified gets its own execution graph
    task_graphs = []

    for task in do_tasks:
        exgraph = DiGraph()
        exgraph.add_node(task)
        _get_deps(task, exgraph, dep_graph)

        task_graphs.append(exgraph)

    return flatten(reversed(topological_sort(g)) for g in task_graphs)