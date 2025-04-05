def extendMarkdown(self, md, md_globals):
        """Modifies inline patterns."""
        mark_tag = SimpleTagPattern(MARK_RE, 'mark')
        md.inlinePatterns.add('mark', mark_tag, '_begin')