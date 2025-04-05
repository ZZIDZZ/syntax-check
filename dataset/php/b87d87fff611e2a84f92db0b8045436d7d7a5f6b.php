private function parser($page)
	{
		$templateTime = clone $this->date;
		$hours = array();
		$array = array();
		
		# Get only table
		$page =  preg_replace('#(.+)\<tbody\>(.+)\<\/tbody\>(.+)#siU', '<table>$2</table>', $page);
		
		# save to DomDocument
		$dom = new DomDocument();
		libxml_use_internal_errors(true);
		
		# Load and save informations
		$dom->loadHTML($page);
		$raws = $dom->getElementsByTagName('tr');
		foreach($raws as $cKey => $raw)
		{
			if($cKey > 1)
			{
				$cells = $raw->getElementsByTagName('td');
				foreach($cells as $rKey => $cell)
				{
					$hours[$rKey][] = mb_convert_encoding($cell->nodeValue, mb_internal_encoding(), 'ISO-8859-1');
				}
			}
		}
		
		# Informations restructuration
		foreach($hours[0] as $placeKey => $place)
		{
			$size = count($hours);
			$array[$placeKey] = 
			array(
				'place' => $place,
				'hours' => array()
			);
			for($i = 1; $i<$size; $i++)
			{
				$hourValue = $hours[$i][$placeKey];
				$hourValue = ($hourValue == '-') ? null : $hourValue;
				if(null !== $hourValue)
				{
					$cellHour = explode(':', $hourValue);
					$templateTime->setTime(intval($cellHour[0]), intval($cellHour[1]));
					$hourValue = $templateTime->getTimestamp();
				}
				$array[$placeKey]['hours'][] = $hourValue;
			}
		}
		return $array;
	}