def from_usi(cls, usi):
        '''
        Parses an USI string.
        Raises `ValueError` if the USI string is invalid.
        '''
        if usi == '0000':
            return cls.null()
        elif len(usi) == 4:
            if usi[1] == '*':
                piece = Piece.from_symbol(usi[0])
                return cls(None, SQUARE_NAMES.index(usi[2:4]), False, piece.piece_type)
            else:
                return cls(SQUARE_NAMES.index(usi[0:2]), SQUARE_NAMES.index(usi[2:4]))
        elif len(usi) == 5 and usi[4] == '+':
            return cls(SQUARE_NAMES.index(usi[0:2]), SQUARE_NAMES.index(usi[2:4]), True)
        else:
            raise ValueError('expected usi string to be of length 4 or 5')