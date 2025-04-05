def atomize(f, lock=None):
	"""
	Decorate a function with a reentrant lock to prevent multiple
	threads from calling said thread simultaneously.
	"""
	lock = lock or threading.RLock()

	@functools.wraps(f)
	def exec_atomic(*args, **kwargs):
		lock.acquire()
		try:
			return f(*args, **kwargs)
		finally:
			lock.release()
	return exec_atomic