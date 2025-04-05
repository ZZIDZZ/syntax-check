func ConvertResponse(re *Response, err error) (*Response, error) {
	if err != nil {
		if uerr, ok := err.(*url.Error); ok && uerr != nil && uerr.Err != nil {
			return nil, trace.Wrap(uerr.Err)
		}
		return nil, trace.Wrap(err)
	}
	return re, trace.ReadError(re.Code(), re.Bytes())
}