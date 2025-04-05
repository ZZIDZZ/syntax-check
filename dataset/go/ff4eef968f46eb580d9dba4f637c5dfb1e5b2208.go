func ReadCommand(r *bufio.Reader) (cmd Command, err error) {
	var line string

	if line, err = r.ReadString('\n'); err != nil {
		return
	}

	parts := strings.Split(strings.TrimSpace(line), " ")

	if len(parts) == 0 {
		err = makeErrInvalid("invalid empty command")
		return
	}

	switch name, args := parts[0], parts[1:]; name {
	case "PING":
		return readPing(args...)

	case "IDENTIFY":
		return readIdentify(r, args...)

	case "REGISTER":
		return readRegister(args...)

	case "UNREGISTER":
		return readUnregister(args...)

	default:
		err = makeErrInvalid("invalid command %s", name)
		return
	}
}