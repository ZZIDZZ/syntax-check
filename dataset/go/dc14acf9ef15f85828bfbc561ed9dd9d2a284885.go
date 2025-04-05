func (cdc *Codec) MarshalJSONIndent(o interface{}, prefix, indent string) ([]byte, error) {
	bz, err := cdc.MarshalJSON(o)
	if err != nil {
		return nil, err
	}
	var out bytes.Buffer
	err = json.Indent(&out, bz, prefix, indent)
	if err != nil {
		return nil, err
	}
	return out.Bytes(), nil
}