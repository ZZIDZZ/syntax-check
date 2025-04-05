private function selectInternal(callable $callback, $query, array $bindValues = null) {
		$this->normalizeConnection();

		try {
			// create a prepared statement from the supplied SQL string
			$stmt = $this->pdo->prepare($query);
		}
		catch (PDOException $e) {
			ErrorHandler::rethrow($e);
		}

		// if a performance profiler has been defined
		if (isset($this->profiler)) {
			$this->profiler->beginMeasurement();
		}

		/** @var PDOStatement $stmt */

		// bind the supplied values to the query and execute it
		try {
			$stmt->execute($bindValues);
		}
		catch (PDOException $e) {
			ErrorHandler::rethrow($e);
		}

		// if a performance profiler has been defined
		if (isset($this->profiler)) {
			$this->profiler->endMeasurement($query, $bindValues, 1);
		}

		// fetch the desired results from the result set via the supplied callback
		$results = $callback($stmt);

		$this->denormalizeConnection();

		// if the result is empty
		if (empty($results) && $stmt->rowCount() === 0) {
			// consistently return `null`
			return null;
		}
		// if some results have been found
		else {
			// return these as extracted by the callback
			return $results;
		}
	}