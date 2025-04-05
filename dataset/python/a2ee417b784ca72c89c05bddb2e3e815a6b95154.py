def from_str(cls, human_readable_str, decimal=False, bits=False):
        """attempt to parse a size in bytes from a human-readable string."""
        divisor = 1000 if decimal else 1024
        num = []
        c = ""
        for c in human_readable_str:
            if c not in cls.digits:
                break
            num.append(c)
        num = "".join(num)
        try:
            num = int(num)
        except ValueError:
            num = float(num)
        if bits:
            num /= 8
        return cls(round(num * divisor ** cls.key[c.lower()]))