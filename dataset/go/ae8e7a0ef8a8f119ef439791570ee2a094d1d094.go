func Search(st string, mx time.Duration) ([]SearchResponse, error) {
	conn, err := listenForSearchResponses()
	if err != nil {
		return nil, err
	}
	defer conn.Close()

	searchBytes, broadcastAddr := buildSearchRequest(st, mx)
	// Write search bytes on the wire so all devices can respond
	_, err = conn.WriteTo(searchBytes, broadcastAddr)
	if err != nil {
		return nil, err
	}

	return readSearchResponses(conn, mx)
}