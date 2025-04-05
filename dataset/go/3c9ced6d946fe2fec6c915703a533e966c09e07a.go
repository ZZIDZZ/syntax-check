func finishesCall(f *Frame) bool {
	switch f.messageType() {
	case messageTypeError:
		return true
	case messageTypeCallRes, messageTypeCallResContinue:
		flags := f.Payload[_flagsIndex]
		return flags&hasMoreFragmentsFlag == 0
	default:
		return false
	}
}