func (p ParamSet) Unmarshal(v interface{}) error {
	return json.NewDecoder(p.reader).Decode(v)
}