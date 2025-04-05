func ReadIndexTable(r io.Reader) (IndexTable, error) {
	idx := IndexTable{}
	d, err := da.Read(r)
	if err != nil {
		return idx, fmt.Errorf("read index error, %v", err)
	}
	idx.Da = d

	dec := gob.NewDecoder(r)
	if e := dec.Decode(&idx.Dup); e != nil {
		return idx, fmt.Errorf("read index dup table error, %v", e)
	}

	return idx, nil
}