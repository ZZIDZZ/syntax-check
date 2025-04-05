public static function createFromString(string $interval): self
	{
		list($from, $to) = explode(self::$delimiter, $interval);

		$dateFrom = DateTime::createFromFormat(self::$format, $from);
		$dateTo = DateTime::createFromFormat(self::$format, $to);

		return new self($dateFrom, $dateTo);
	}