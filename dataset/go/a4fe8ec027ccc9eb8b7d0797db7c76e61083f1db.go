func (seq *Seq) RemoveAt(index int) {
	C.cvSeqRemove((*C.struct_CvSeq)(seq), C.int(index))
}