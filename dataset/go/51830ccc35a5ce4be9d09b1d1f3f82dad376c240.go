func StereoPan(buf *audio.FloatBuffer, pan float64) error {
	if buf == nil || buf.Format == nil || buf.Format.NumChannels != 2 {
		return audio.ErrInvalidBuffer
	}
	if pan < 0 || pan > 1 {
		return errors.New("invalid pan value, should be betwen 0 and 1")
	}
	if pan == 0.5 {
		return nil
	}

	if pan < 0.5 {
		for i := 0; i+2 <= len(buf.Data); i += 2 {
			buf.Data[i+1] *= (pan * 2)
		}
	} else {
		for i := 0; i+2 <= len(buf.Data); i += 2 {
			buf.Data[i] *= ((1 - pan) * 2)
		}
	}

	return nil
}