func (s *Selection) MouseToElement() error {
	selectedElement, err := s.elements.GetExactlyOne()
	if err != nil {
		return fmt.Errorf("failed to select element from %s: %s", s, err)
	}

	if err := s.session.MoveTo(selectedElement.(*api.Element), nil); err != nil {
		return fmt.Errorf("failed to move mouse to element for %s: %s", s, err)
	}

	return nil
}