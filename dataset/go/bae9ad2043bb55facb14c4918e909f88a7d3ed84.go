func reducedDuplexRow1(state []uint64, rowIn []uint64, rowOut []uint64, nCols int) {
	ptrIn := 0
	ptrOut := (nCols - 1) * blockLenInt64

	for i := 0; i < nCols; i++ {
		ptrWordIn := rowIn[ptrIn:]    //In Lyra2: pointer to prev
		ptrWordOut := rowOut[ptrOut:] //In Lyra2: pointer to row
		//Absorbing "M[prev][col]"
		state[0] ^= (ptrWordIn[0])
		state[1] ^= (ptrWordIn[1])
		state[2] ^= (ptrWordIn[2])
		state[3] ^= (ptrWordIn[3])
		state[4] ^= (ptrWordIn[4])
		state[5] ^= (ptrWordIn[5])
		state[6] ^= (ptrWordIn[6])
		state[7] ^= (ptrWordIn[7])
		state[8] ^= (ptrWordIn[8])
		state[9] ^= (ptrWordIn[9])
		state[10] ^= (ptrWordIn[10])
		state[11] ^= (ptrWordIn[11])

		//Applies the reduced-round transformation f to the sponge's state
		reducedBlake2bLyra(state)

		//M[row][C-1-col] = M[prev][col] XOR rand
		ptrWordOut[0] = ptrWordIn[0] ^ state[0]
		ptrWordOut[1] = ptrWordIn[1] ^ state[1]
		ptrWordOut[2] = ptrWordIn[2] ^ state[2]
		ptrWordOut[3] = ptrWordIn[3] ^ state[3]
		ptrWordOut[4] = ptrWordIn[4] ^ state[4]
		ptrWordOut[5] = ptrWordIn[5] ^ state[5]
		ptrWordOut[6] = ptrWordIn[6] ^ state[6]
		ptrWordOut[7] = ptrWordIn[7] ^ state[7]
		ptrWordOut[8] = ptrWordIn[8] ^ state[8]
		ptrWordOut[9] = ptrWordIn[9] ^ state[9]
		ptrWordOut[10] = ptrWordIn[10] ^ state[10]
		ptrWordOut[11] = ptrWordIn[11] ^ state[11]

		//Input: next column (i.e., next block in sequence)
		ptrIn += blockLenInt64
		//Output: goes to previous column
		ptrOut -= blockLenInt64
	}
}