def main(context, **kwargs):
    """
    virtue discovers and runs tests found in the given objects.

    Provide it with one or more tests (packages, modules or objects) to run.

    """

    result = run(**kwargs)
    context.exit(not result.wasSuccessful())