func (m *Map) SetBufferSize(s int) {
	C.mapnik_map_set_buffer_size(m.m, C.int(s))
}