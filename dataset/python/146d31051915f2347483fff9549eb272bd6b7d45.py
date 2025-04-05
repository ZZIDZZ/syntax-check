def load_all_modules_in_packages(package_or_set_of_packages):
    """
    Recursively loads all modules from a package object, or set of package objects

    :param package_or_set_of_packages: package object, or iterable of package objects
    :return: list of all unique modules discovered by the function
    """
    if isinstance(package_or_set_of_packages, types.ModuleType):
        packages = [package_or_set_of_packages]
    elif isinstance(package_or_set_of_packages, Iterable) and not isinstance(package_or_set_of_packages, (dict, str)):
        packages = package_or_set_of_packages
    else:
        raise Exception("This function only accepts a module reference, or an iterable of said objects")

    imported = packages.copy()

    for package in packages:
        if not hasattr(package, '__path__'):
            raise Exception(
                'Package object passed in has no __path__ attribute. '
                'Make sure to pass in imported references to the packages in question.'
            )

        for module_finder, name, ispkg in pkgutil.walk_packages(package.__path__):
            module_name = '{}.{}'.format(package.__name__, name)
            current_module = importlib.import_module(module_name)
            imported.append(current_module)
            if ispkg:
                imported += load_all_modules_in_packages(current_module)

    for module in imported:
        # This is to cover cases where simply importing a module doesn't execute all the code/definitions within
        # I don't totally understand the reasons for this, but I do know enumerating a module's context (like with dir)
        # seems to solve things
        dir(module)

    return list(
        {
            module.__name__: module

            for module in imported
        }.values()
    )