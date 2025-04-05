func NewV5(namespaceUUID *UUID, name []byte) *UUID {
	uuid := newByHash(sha1.New(), namespaceUUID, name)
	uuid[6] = (uuid[6] & 0x0f) | 0x50
	return uuid
}