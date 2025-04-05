def valid_scrabble_word(word):
    """Checks if the input word could be played with a full bag of tiles.

    Returns:
        True or false
    """

    letters_in_bag = {
        "a": 9,
        "b": 2,
        "c": 2,
        "d": 4,
        "e": 12,
        "f": 2,
        "g": 3,
        "h": 2,
        "i": 9,
        "j": 1,
        "k": 1,
        "l": 4,
        "m": 2,
        "n": 6,
        "o": 8,
        "p": 2,
        "q": 1,
        "r": 6,
        "s": 4,
        "t": 6,
        "u": 4,
        "v": 2,
        "w": 2,
        "x": 1,
        "y": 2,
        "z": 1,
        "_": 2,
    }

    for letter in word:
        if letter == "?":
            continue
        try:
            letters_in_bag[letter] -= 1
        except KeyError:
            return False
        if letters_in_bag[letter] < 0:
            letters_in_bag["_"] -= 1
            if letters_in_bag["_"] < 0:
                return False
    return True