def init_parser():
    """ function to init option parser """
    usage = "usage: %prog -u user -s secret -n name [-l label] \
[-t title] [-c callback] [TEXT]"

    parser = OptionParser(usage, version="%prog " + notifo.__version__)
    parser.add_option("-u", "--user", action="store", dest="user",
                      help="your notifo username")
    parser.add_option("-s", "--secret", action="store", dest="secret",
                      help="your notifo API secret")
    parser.add_option("-n", "--name", action="store", dest="name",
                      help="recipient for the notification")
    parser.add_option("-l", "--label", action="store", dest="label",
                      help="label for the notification")
    parser.add_option("-t", "--title", action="store", dest="title",
                      help="title of the notification")
    parser.add_option("-c", "--callback", action="store", dest="callback",
                      help="callback URL to call")
    parser.add_option("-m", "--message", action="store_true", dest="message",
                      default=False, help="send message instead of notification")

    (options, args) = parser.parse_args()
    return (parser, options, args)