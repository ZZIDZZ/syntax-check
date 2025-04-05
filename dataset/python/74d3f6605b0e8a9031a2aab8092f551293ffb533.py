def decode_obj(obj, force=False):
	'Convert or dump object to unicode.'
	if isinstance(obj, unicode): return obj
	elif isinstance(obj, bytes):
		if force_encoding is not None: return obj.decode(force_encoding)
		if chardet:
			enc_guess = chardet.detect(obj)
			if enc_guess['confidence'] > 0.7:
				return obj.decode(enc_guess['encoding'])
		return obj.decode('utf-8')
	else:
		return obj if not force else repr(obj)