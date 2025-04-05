func CallErr(f func() error) error {
	checkRun()
	errChan := make(chan error)
	callQueue <- func() {
		errChan <- f()
	}
	return <-errChan
}