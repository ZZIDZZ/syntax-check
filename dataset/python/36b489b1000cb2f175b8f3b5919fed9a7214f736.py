def set_chance(cls, files, equal=False, offensive=False, lang=None): # where files are (name, chance)
        """Initialize based on a list of fortune files with set chances"""
        self = cls.__new__(cls)
        total = 0.
        file = []
        leftover = []
        for name, chance in files:
            if total >= 1:
                break
            fortune = load_fortune(name, offensive=offensive, lang=lang)
            if fortune is None or not fortune.size:
                continue
            if chance:
                file.append((fortune, chance))
                total += chance
            else:
                leftover.append(fortune)
        if leftover and total < 1:
            left = 1 - total
            if equal:
                perfile = left / len(leftover)
                for fortune in leftover:
                    file.append((fortune, perfile))
            else:
                entries = sum(map(attrgetter('size'), leftover))
                logger.debug('%d entries left', entries)
                for fortune in leftover:
                    chance = left * fortune.size / entries
                    file.append((fortune, chance))
        
        # Arbitrary limit to calculate upper bound with, nice round number
        self.count = count = 65536
        bound = 0
        self.files = fortunes = []
        for file, chance in file:
            bound += int(chance * count)
            fortunes.append((file, bound))
        self.keys = [i[1] for i in self.files]
        return self