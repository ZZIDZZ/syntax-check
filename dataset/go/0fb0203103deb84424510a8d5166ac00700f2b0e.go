func (s Service) OffHandler(w http.ResponseWriter, r *http.Request) {
	changed, err := s.store.Off()
	if err != nil {
		s.logger.Errorf("maintenance off: %s", err)
		jsonInternalServerErrorResponse(w)
		return
	}
	if changed {
		s.logger.Infof("maintenance off")
	}
	jsonOKResponse(w)
}