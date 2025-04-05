func (b *TupleBuilder) PutTuple(field string, value Tuple) (wrote int, err error) {

	// field type should be
	if err = b.typeCheck(field, TupleField); err != nil {
		return 0, err
	}

	size := value.Size() + value.Header.Size()
	if size < math.MaxUint8 {

		// check length
		if b.available() < size+2 {
			return 0, xbinary.ErrOutOfRange
		}

		// write type code
		b.buffer[b.pos] = byte(Tuple8Code.OpCode)

		// write length
		b.buffer[b.pos+1] = byte(size)
		wrote += 2

		// Write tuple
		n, err := b.writeTuple(value, b.pos+wrote, size)
		wrote += int(n)

		// Return err
		if err != nil {
			return 0, err
		}

	} else if size < math.MaxUint16 {

		// check length
		if b.available() < size+3 {
			return 0, xbinary.ErrOutOfRange
		}

		// write type code
		b.buffer[b.pos] = byte(Tuple16Code.OpCode)

		// write length
		xbinary.LittleEndian.PutUint16(b.buffer, b.pos+1, uint16(size))
		wrote += 3

		// write tuple
		n, err := b.writeTuple(value, b.pos+wrote, size)
		// n, err := value.WriteAt(&b.buffer, int64(b.pos+3))
		wrote += int(n)

		// Return err
		if err != nil {
			return 0, err
		}

	} else if size < math.MaxUint32 {

		// check length
		if b.available() < size+5 {
			return 0, xbinary.ErrOutOfRange
		}

		// write type code
		b.buffer[b.pos] = byte(Tuple32Code.OpCode)

		// write length
		xbinary.LittleEndian.PutUint32(b.buffer, b.pos+1, uint32(size))
		wrote += 5

		// write tuple
		n, err := b.writeTuple(value, b.pos+wrote, size)
		// n, err := value.WriteAt(&b.buffer, int64(b.pos+5))
		wrote += int(n)

		// Return err
		if err != nil {
			return 0, err
		}

	} else {

		// check length
		if b.available() < size+9 {
			return 0, xbinary.ErrOutOfRange
		}

		// write type code
		b.buffer[b.pos] = byte(Tuple64Code.OpCode)

		// write length
		xbinary.LittleEndian.PutUint64(b.buffer, b.pos+1, uint64(size))
		wrote += 9

		// write tuple
		n, err := b.writeTuple(value, b.pos+wrote, size)
		// n, err := value.WriteAt(&b.buffer, int64(b.pos+9))
		wrote += int(n)

		// Return err
		if err != nil {
			return 0, err
		}
	}

	// store offset and increment position
	b.offsets[field] = b.pos
	b.pos += wrote
	return
}