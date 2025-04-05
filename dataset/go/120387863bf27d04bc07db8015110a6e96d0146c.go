func BindVariablesEqual(x, y map[string]*querypb.BindVariable) bool {
	return reflect.DeepEqual(&querypb.BoundQuery{BindVariables: x}, &querypb.BoundQuery{BindVariables: y})
}