function(options) {
            var table = options.table, key, revCharsTable = options.revCharsTable;
            if (!table) {
                throw new Error("Encoding '" + options.type +"' has incorect 'table' option");
            }
            if(!revCharsTable) {
                revCharsTable = options.revCharsTable = {};
                for (key in table) {
                    revCharsTable[table[key]] = parseInt(key);
                }
            }
            
            return {
                toEncoding: function(str) {
                    str = ensureString(str);
                    var strLen = str.length;
                    var bufLen = strLen;
                    for (var i = 0; i < strLen; i++)
                        if (str.charCodeAt(i) >> 7)
                            bufLen++;

                    var newBuf = new Buffer(bufLen), gbkcode, unicode, 
                        defaultChar = revCharsTable[iconv.defaultCharUnicode.charCodeAt(0)];

                    for (var i = 0, j = 0; i < strLen; i++) {
                        unicode = str.charCodeAt(i);
                        if (unicode >> 7) {
                            gbkcode = revCharsTable[unicode] || defaultChar;
                            newBuf[j++] = gbkcode >> 8; //high byte;
                            newBuf[j++] = gbkcode & 0xFF; //low byte
                        } else {//ascii
                            newBuf[j++] = unicode;
                        }
                    }
                    return newBuf;
                },
                fromEncoding: function(buf) {
                    buf = ensureBuffer(buf);
                    var bufLen = buf.length, strLen = 0;
                    for (var i = 0; i < bufLen; i++) {
                        strLen++;
                        if (buf[i] & 0x80) //the high bit is 1, so this byte is gbkcode's high byte.skip next byte
                            i++;
                    }
                    var newBuf = new Buffer(strLen*2), unicode, gbkcode,
                        defaultChar = iconv.defaultCharUnicode.charCodeAt(0);
                    
                    for (var i = 0, j = 0; i < bufLen; i++, j+=2) {
                        gbkcode = buf[i];
                        if (gbkcode & 0x80) {
                            gbkcode = (gbkcode << 8) + buf[++i];
                            unicode = table[gbkcode] || defaultChar;
                        } else {
                            unicode = gbkcode;
                        }
                        newBuf[j] = unicode & 0xFF; //low byte
                        newBuf[j+1] = unicode >> 8; //high byte
                    }
                    return newBuf.toString('ucs2');
                }
            }
        }