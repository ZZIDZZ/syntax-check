def find_globals(code):
        """walks the byte code to find the variables which are actually globals"""
        cur_byte = 0
        byte_code = code.co_code
        
        names = set()
        while cur_byte < len(byte_code):
            op = ord(byte_code[cur_byte])

            if op >= dis.HAVE_ARGUMENT:
                if op == _LOAD_GLOBAL:
                    oparg = ord(byte_code[cur_byte + 1]) + (ord(byte_code[cur_byte + 2]) << 8)
                    name = code.co_names[oparg]
                    names.add(name)

                cur_byte += 2
            cur_byte += 1
        
        return names