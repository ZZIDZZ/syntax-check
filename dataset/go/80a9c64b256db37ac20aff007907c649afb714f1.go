func (da *Cedar) Delete(key []byte) error {
	// if the path does not exist, or the end is not a leaf, nothing to delete
	to, err := da.Jump(key, 0)
	if err != nil {
		return ErrNoPath
	}

	if da.Array[to].Value < 0 {
		base := da.Array[to].base()
		if da.Array[base].Check == to {
			to = base
		}
	}

	for to > 0 {
		from := da.Array[to].Check
		base := da.Array[from].base()
		label := byte(to ^ base)

		// if `to` has sibling, remove `to` from the sibling list, then stop
		if da.Ninfos[to].Sibling != 0 || da.Ninfos[from].Child != label {
			// delete the label from the child ring first
			da.popSibling(from, base, label)
			// then release the current node `to` to the empty node ring
			da.pushEnode(to)
			break
		}
		// otherwise, just release the current node `to` to the empty node ring
		da.pushEnode(to)
		// then check its parent node
		to = from
	}
	return nil
}