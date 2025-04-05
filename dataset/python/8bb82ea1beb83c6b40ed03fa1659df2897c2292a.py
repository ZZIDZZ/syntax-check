def text_index(self):
        '''Returns the one-based index of the current text node.'''
        # This is the number of text nodes we've seen so far.
        # If we are currently in a text node, great; if not then add
        # one for the text node that's about to begin.
        i = self.tags.get(TextElement, 0)
        if self.last_tag is not TextElement:
            i += 1
        return i