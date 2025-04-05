func MarshalStr(n tree.Node) (string, error) {
	ret := bytes.NewBufferString("")
	err := marshal(n, ret)

	return ret.String(), err
}