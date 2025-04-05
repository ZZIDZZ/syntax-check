def base_tokenizer(fp):
    'Tokenizer. Generates tokens stream from text'
    if isinstance(fp, StringIO):
        template_file = fp
        size = template_file.len
    else:
        #empty file check
        if os.fstat(fp.fileno()).st_size == 0:
            yield TOKEN_EOF, 'EOF', 0, 0
            return
        template_file = mmap.mmap(fp.fileno(), 0, access=mmap.ACCESS_READ)
        size = template_file.size()
    lineno = 0
    while 1:
        lineno += 1
        pos = 1

        # end of file
        if template_file.tell() == size:
            yield TOKEN_EOF, 'EOF', lineno, 0
            break

        # now we tokinize line by line
        line = template_file.readline().decode('utf-8')
        line = line.replace('\r\n', '')
        line = line.replace('\n', '')
        # ignoring non XML comments
        if re_comment.match(line):
            continue

        last_text = deque()
        while line:
            line_len = len(line)
            for token in tokens:
                m = token.regex.match(line)
                if m:
                    if last_text:
                        yield TOKEN_TEXT, ''.join(last_text), lineno, pos
                        pos += len(last_text)
                        last_text.clear()
                    offset, value = m.end(), m.group()
                    line = line[offset:]
                    yield token, value, lineno, pos
                    pos += offset
                    break

            # we did not get right in tokens list, so next char is text
            if line_len == len(line):
                last_text.append(line[0])
                line = line[1:]

        if last_text:
            yield TOKEN_TEXT, ''.join(last_text), lineno, pos
            pos += len(last_text)
            last_text.clear()
        yield TOKEN_NEWLINE, '\n', lineno, pos

    # all work is done
    template_file.close()