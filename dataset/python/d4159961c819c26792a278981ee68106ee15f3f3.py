def create_all_tasks(element):
    """Create all tasks for the element

    :param element: The shot or asset that needs tasks
    :type element: :class:`muke.models.Shot` | :class:`muke.models.Asset`
    :returns: None
    :rtype: None
    :raises: None
    """
    prj = element.project
    if isinstance(element, Asset):
        flag=True
    else:
        flag=False
    deps = prj.department_set.filter(assetflag=flag)
    for d in deps:
        t = Task(project=prj, department=d, element=element)
        t.full_clean()
        t.save()