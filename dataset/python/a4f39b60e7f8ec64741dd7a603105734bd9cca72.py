def parse_args():
    """
    Parses command line args using argparse library
    """
    usage = "Usage: create_concordance <infile> [<outfile>]"
    description = "Simple Concordance Generator"
    argparser = argparse.ArgumentParser(
        usage=usage, description=description)

    argparser.add_argument(
        'infile', type=argparse.FileType('r'),
        help="File read in to create concordance")

    argparser.add_argument(
        'outfile', nargs='?', type=argparse.FileType('w'),
        default=sys.stdout, help="File to write concordance to.  "
        "Default is stdout")

    argparser.add_argument(
        '--word', nargs="?", const=str, help="Display a word in concordance")
    args = argparser.parse_args()
    return args