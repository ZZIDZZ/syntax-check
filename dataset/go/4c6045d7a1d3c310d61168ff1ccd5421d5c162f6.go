func (p *Pushy) NotifyDevice(request SendNotificationRequest) (*NotificationResponse, *Error, error) {
	url := fmt.Sprintf("%s/push?api_key=%s", p.APIEndpoint, p.APIToken)
	var success *NotificationResponse
	var pushyErr *Error
	err := post(p.httpClient, url, request, &success, &pushyErr)
	return success, pushyErr, err
}