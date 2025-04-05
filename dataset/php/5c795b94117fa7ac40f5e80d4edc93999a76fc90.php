public function append(LoggerLoggingEvent $event) {
		$eventDate = $this->getDate($event->getTimestamp());
		
		// Initial setting of current date
		if (!isset($this->currentDate)) {
			$this->currentDate = $eventDate;
		} 
		
		// Check if rollover is needed
		else if ($this->currentDate !== $eventDate) {
			$this->currentDate = $eventDate;
			
			// Close the file if it's open.
			// Note: $this->close() is not called here because it would set
			//       $this->closed to true and the appender would not recieve
			//       any more logging requests
			if (is_resource($this->fp)) {
				$this->write($this->layout->getFooter());
				fclose($this->fp);
			}
			$this->fp = null;
		}
	
		parent::append($event);
	}