def do_STRDISTANCE(self, s):
        """Print the distance score between two strings. Use | as separator.
        STRDISTANCE rue des lilas|porte des lilas"""
        s = s.split('|')
        if not len(s) == 2:
            print(red('Malformed string. Use | between the two strings.'))
            return
        one, two = s
        print(white(compare_str(one, two)))