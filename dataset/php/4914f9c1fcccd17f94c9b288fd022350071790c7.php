public function printLine(string $string = null): void
	{
		if ($string !== null) {
			echo $string;
		}
		if ($this->isConsole) {
			echo "\n";
		} else {
			echo '<br/>';
		}
	}