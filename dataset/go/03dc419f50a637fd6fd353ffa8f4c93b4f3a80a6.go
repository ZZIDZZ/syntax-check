func (s *Sapin) compute() {
	if s.output != "" {
		return
	}
	// size of the last line of the last floor
	maxSize := s.GetMaxSize()

	// each floor in the floors
	for floor := 0; floor < s.Size; floor++ {

		// each line in the lines of the floor
		for line := 0; line < floor+4; line++ {

			// size of the current line
			lineSize := s.GetLineSize(floor, line)

			// pad left with spaces
			for i := (maxSize-lineSize)/2 - 1; i > 0; i-- {
				s.putchar(" ")
			}

			// draw the body
			for i := 0; i < lineSize; i++ {
				s.putchar("*")
			}

			// new line
			s.putchar("\n")
		}
	}

	// the trunc
	for i := 0; i < s.Size; i++ {
		lineSize := s.Size + (s.Size+1)%2

		// pad left with spaces
		for i := (maxSize-lineSize)/2 - 1; i > 0; i-- {
			s.putchar(" ")
		}

		// draw the body
		for i := 0; i < lineSize; i++ {
			s.putchar("|")
		}

		// new line
		s.putchar("\n")
	}
}