def t_number(self, s):
        r'\d+'
        pos = self.pos
        self.add_token('NUMBER', int(s))
        self.pos = pos + len(s)