func repeated_permutations(list []int, select_num, buf int) (c chan []int) {
	c = make(chan []int, buf)
	go func() {
		defer close(c)
		switch select_num {
		case 1:
			for _, v := range list {
				c <- []int{v}
			}
		default:
			for i := 0; i < len(list); i++ {
				for perm := range repeated_permutations(list, select_num-1, buf) {
					c <- append([]int{list[i]}, perm...)
				}
			}
		}
	}()
	return
}