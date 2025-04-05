func (d *StreamDecoder) Encoder(e Emitter) (enc *StreamEncoder, err error) {
	var typ Type

	if typ, err = d.Parser.ParseType(); err == nil {
		enc = NewStreamEncoder(e)
		enc.oneshot = typ != Array
	}

	return
}