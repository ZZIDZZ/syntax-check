def reset(self):
		"""
		Resets the iterator to the start.

		Any remaining values in the current iteration are discarded.
		"""
		self.__iterator, self.__saved = itertools.tee(self.__saved)