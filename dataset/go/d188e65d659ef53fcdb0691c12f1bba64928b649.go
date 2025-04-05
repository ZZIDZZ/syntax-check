func WriteMatrix(source []rune, target []rune, matrix [][]int, writer io.Writer) {
	fmt.Fprintf(writer, "    ")
	for _, targetRune := range target {
		fmt.Fprintf(writer, "  %c", targetRune)
	}
	fmt.Fprintf(writer, "\n")
	fmt.Fprintf(writer, "  %2d", matrix[0][0])
	for j, _ := range target {
		fmt.Fprintf(writer, " %2d", matrix[0][j+1])
	}
	fmt.Fprintf(writer, "\n")
	for i, sourceRune := range source {
		fmt.Fprintf(writer, "%c %2d", sourceRune, matrix[i+1][0])
		for j, _ := range target {
			fmt.Fprintf(writer, " %2d", matrix[i+1][j+1])
		}
		fmt.Fprintf(writer, "\n")
	}
}