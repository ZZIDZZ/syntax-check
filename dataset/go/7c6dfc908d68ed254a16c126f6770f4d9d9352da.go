func printUsage(w io.Writer) {
	bw := bufio.NewWriter(w)
	tmpl(bw, usageTemplate, commands)
	bw.Flush()
}