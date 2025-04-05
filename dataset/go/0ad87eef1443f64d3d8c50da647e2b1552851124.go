func (l Lockfile) Unlock() error {
	proc, err := l.GetOwner()
	switch err {
	case ErrInvalidPid, ErrDeadOwner:
		return ErrRogueDeletion
	case nil:
		if proc.Pid == os.Getpid() {
			// we really own it, so let's remove it.
			return os.Remove(string(l))
		}
		// Not owned by me, so don't delete it.
		return ErrRogueDeletion
	default:
		// This is an application error or system error.
		// So give a better error for logging here.
		if os.IsNotExist(err) {
			return ErrRogueDeletion
		}
		// Other errors -> defensively fail and let caller handle this
		return err
	}
}