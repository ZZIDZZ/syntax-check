func (s *Client) Call(soapAction string, request, response, header interface{}) error {
	var envelope Envelope
	if s.header != nil {
		envelope = Envelope{
			Header: &Header{
				Content: s.header,
			},
			Body: Body{
				Content: request,
			},
		}
	} else {
		envelope = Envelope{
			Body: Body{
				Content: request,
			},
		}
	}
	buffer := new(bytes.Buffer)
	encoder := xml.NewEncoder(buffer)
	encoder.Indent("  ", "    ")
	if err := encoder.Encode(envelope); err != nil {
		return errors.Wrap(err, "failed to encode envelope")
	}
	if err := encoder.Flush(); err != nil {
		return errors.Wrap(err, "failed to flush encoder")
	}

	req, err := http.NewRequest("POST", s.url, buffer)
	if err != nil {
		return errors.Wrap(err, "failed to create POST request")
	}
	req.Header.Add("Content-Type", "text/xml; charset=\"utf-8\"")
	req.Header.Set("SOAPAction", soapAction)
	req.Header.Set("User-Agent", s.userAgent)
	req.Close = true

	tr := &http.Transport{
		TLSClientConfig: &tls.Config{
			InsecureSkipVerify: s.tls,
		},
		Dial: dialTimeout,
	}

	client := &http.Client{Transport: tr}
	res, err := client.Do(req)
	if err != nil {
		return errors.Wrap(err, "failed to send SOAP request")
	}
	defer res.Body.Close()
	if res.StatusCode != http.StatusOK {
		soapFault, err := ioutil.ReadAll(res.Body)
		if err != nil {
			return errors.Wrap(err, "failed to read SOAP fault response body")
		}
		msg := fmt.Sprintf("HTTP Status Code: %d, SOAP Fault: \n%s", res.StatusCode, string(soapFault))
		return errors.New(msg)
	}

	rawbody, err := ioutil.ReadAll(res.Body)
	if err != nil {
		return errors.Wrap(err, "failed to read SOAP body")
	}
	if len(rawbody) == 0 {
		return nil
	}
	respEnvelope := Envelope{}
	respEnvelope.Body = Body{Content: response}
	if header != nil {
		respEnvelope.Header = &Header{Content: header}
	}

	if err = xml.Unmarshal(rawbody, &respEnvelope); err != nil {
		return errors.Wrap(err, "failed to unmarshal response SOAP Envelope")
	}
	return nil
}