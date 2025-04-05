func (c *CHD) Write(w io.Writer) error {
	write := func(nd ...interface{}) error {
		for _, d := range nd {
			if err := binary.Write(w, binary.LittleEndian, d); err != nil {
				return err
			}
		}
		return nil
	}

	data := []interface{}{
		uint32(len(c.r)), c.r,
		uint32(len(c.indices)), c.indices,
		uint32(len(c.keys)),
	}

	if err := write(data...); err != nil {
		return err
	}

	for i := range c.keys {
		k, v := c.keys[i], c.values[i]
		if err := write(uint32(len(k)), uint32(len(v))); err != nil {
			return err
		}
		if _, err := w.Write(k); err != nil {
			return err
		}
		if _, err := w.Write(v); err != nil {
			return err
		}
	}
	return nil
}