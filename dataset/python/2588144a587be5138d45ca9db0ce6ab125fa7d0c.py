def cli_run():
    """docstring for argparse"""
    parser = argparse.ArgumentParser(description='Stupidly simple code answers from StackOverflow')
    parser.add_argument('query', help="What's the problem ?", type=str, nargs='+')
    parser.add_argument('-t','--tags', help='semicolon separated tags -> python;lambda')
    args = parser.parse_args()
    main(args)