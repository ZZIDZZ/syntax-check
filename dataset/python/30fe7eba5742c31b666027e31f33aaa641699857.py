def main(clargs=None):
    """Command line entry point."""
    from argparse import ArgumentParser
    from librarian.library import Library
    import sys

    parser = ArgumentParser(
        description="A test runner for each card in a librarian library.")
    parser.add_argument("library", help="Library database")
    parser.add_argument("-t", "--tests", default="test/",
                        help="Test directory")
    args = parser.parse_args(clargs)

    descovery(args.tests)

    library = Library(args.library)
    cardcount, passes, failures = execute_tests(library)
    print(RESULTS.format(len(SINGLES), len(TESTS), cardcount, passes,
                         failures))
    sys.exit(failures)