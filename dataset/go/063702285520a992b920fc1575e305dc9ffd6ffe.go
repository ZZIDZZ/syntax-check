func (e *Error) Error() string {
	return fmt.Sprintf("VIX Error: %s, code: %d, operation: %s", e.Text, e.Code, e.Operation)
}