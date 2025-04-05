func growPartSize(partIndex int, partSize, putsz int64) bool {
	return (maxObjSize-putsz)/(maxNPart-int64(partIndex)) > partSize
}