def get_true_anomaly(self):
		"""
		Return the true anomaly at each time
		"""
		self.f = _rsky._getf(self.t_supersample, self.t0, self.per, self.a,
							  self.inc*pi/180., self.ecc, self.w*pi/180.,
							  self.transittype, self.nthreads)
		return self.f