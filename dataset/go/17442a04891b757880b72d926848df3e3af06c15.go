func TriggerIncidentKeyWithDetails(description string, key string, details map[string]interface{}) (incidentKey string, err error) {
	return trigger(description, key, details)
}