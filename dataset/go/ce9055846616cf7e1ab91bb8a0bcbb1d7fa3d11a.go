func (h *HTTP) Fetch() (io.Reader, error) {
	//delay fetches after first
	if h.delay {
		time.Sleep(h.Interval)
	}
	h.delay = true
	//status check using HEAD
	resp, err := http.Head(h.URL)
	if err != nil {
		return nil, fmt.Errorf("HEAD request failed (%s)", err)
	}
	resp.Body.Close()
	if resp.StatusCode != http.StatusOK {
		return nil, fmt.Errorf("HEAD request failed (status code %d)", resp.StatusCode)
	}
	//if all headers match, skip update
	matches, total := 0, 0
	for _, header := range h.CheckHeaders {
		if curr := resp.Header.Get(header); curr != "" {
			if last, ok := h.lasts[header]; ok && last == curr {
				matches++
			}
			h.lasts[header] = curr
			total++
		}
	}
	if matches == total {
		return nil, nil //skip, file match
	}
	//binary fetch using GET
	resp, err = http.Get(h.URL)
	if err != nil {
		return nil, fmt.Errorf("GET request failed (%s)", err)
	}
	if resp.StatusCode != http.StatusOK {
		return nil, fmt.Errorf("GET request failed (status code %d)", resp.StatusCode)
	}
	//extract gz files
	if strings.HasSuffix(h.URL, ".gz") && resp.Header.Get("Content-Encoding") != "gzip" {
		return gzip.NewReader(resp.Body)
	}
	//success!
	return resp.Body, nil
}