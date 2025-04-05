def _potential_wins(self):
        '''Generates all the combinations of board positions that need
        to be checked for a win.'''
        yield from self.board
        yield from zip(*self.board)
        yield self.board[0][0], self.board[1][1], self.board[2][2]
        yield self.board[0][2], self.board[1][1], self.board[2][0]