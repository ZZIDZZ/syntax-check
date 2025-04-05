func getUniversalType(t reflect.Type) (tagNumber int, isCompound, ok bool) {
	switch t {
	case objectIdentifierType:
		return tagOID, false, true
	case bitStringType:
		return tagBitString, false, true
	case timeType:
		return tagUTCTime, false, true
	case enumeratedType:
		return tagEnum, false, true
	case bigIntType:
		return tagInteger, false, true
	}
	switch t.Kind() {
	case reflect.Bool:
		return tagBoolean, false, true
	case reflect.Int, reflect.Int8, reflect.Int16, reflect.Int32, reflect.Int64:
		return tagInteger, false, true
	case reflect.Struct:
		return tagSequence, true, true
	case reflect.Slice:
		if t.Elem().Kind() == reflect.Uint8 {
			return tagOctetString, false, true
		}
		if strings.HasSuffix(t.Name(), "SET") {
			return tagSet, true, true
		}
		return tagSequence, true, true
	case reflect.String:
		return tagPrintableString, false, true
	}
	return 0, false, false
}