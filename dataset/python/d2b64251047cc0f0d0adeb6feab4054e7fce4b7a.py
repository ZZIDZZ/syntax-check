def Free(self):
    '''
    Frees the memory used by all of the dynamically allocated C arrays.
    
    '''

    if self.arrays._calloc:
      _dbl_free(self.arrays._time)
      _dbl_free(self.arrays._flux)
      _dbl_free(self.arrays._bflx)
      _dbl_free(self.arrays._M)
      _dbl_free(self.arrays._E)
      _dbl_free(self.arrays._f)
      _dbl_free(self.arrays._r)
      _dbl_free(self.arrays._x)
      _dbl_free(self.arrays._y)
      _dbl_free(self.arrays._z)
      self.arrays._calloc = 0
    if self.arrays._balloc:  
      _dbl_free(self.arrays._b)
      self.arrays._balloc = 0
    if self.arrays._ialloc:
      _dbl_free(self.arrays._iarr)
      self.arrays._ialloc = 0