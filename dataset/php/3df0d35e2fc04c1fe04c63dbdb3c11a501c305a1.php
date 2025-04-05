protected static function _buildFilter($user, $action, $extra, $filter_wrap = false)
	{
		$Driver = QuickBooks_Driver_Singleton::getInstance();
		$xml = '';
		$type = '';
			
		$key_prev = QuickBooks_Callbacks_SQL_Callbacks::_keySyncPrev($action);
		$key_curr = QuickBooks_Callbacks_SQL_Callbacks::_keySyncCurr($action);
			
		$module = __CLASS__;
			
		//$action = null;
		$type = null;
		$opts = null;
		// 					configRead($user, $module, $key, &$type, &$opts)
		$prev_sync_datetime = $Driver->configRead($user, $module, $key_prev, $type, $opts);	// last sync started... 
		
		if (!$prev_sync_datetime)
		{
			// If this query has *never* run before, let's get *all* of the records
			$timestamp = time() - (60 * 60 * 24 * 365 * 25);
			$prev_sync_datetime = date('Y-m-d', $timestamp) . 'T' . date('H:i:s', $timestamp);
			$extra = array();			// If an iterator exists, get rid of it (this should *never* happen... how could it?)
			
			//			configWrite($user, $module, $key, $value, $type, $opts
			$Driver->configWrite($user, $module, $key_prev, $prev_sync_datetime, null);
		}
		
		// @TODO MAKE SURE THIS DOESN'T BREAK ANYTHING! 
		$prev_sync_datetime = date('Y-m-d', strtotime($prev_sync_datetime) - 600) . 'T' . date('H:i:s', strtotime($prev_sync_datetime) - 600);
		
		if (!is_array($extra) or
			empty($extra['iteratorID'])) 	// Checks to see if this is the first iteration or not
		{
			// Start of a new iterator!
			
			// Store when we started to do this iterator (this will become the $prev_sync_datetime after we finish with this iterator)
			$curr_sync_datetime = date('Y-m-d') . 'T' . date('H:i:s');
			$Driver->configWrite($user, $module, $key_curr, $curr_sync_datetime, null);
			
			if ($filter_wrap)
			{
				if ($action == QUICKBOOKS_QUERY_DELETEDLISTS or $action == QUICKBOOKS_QUERY_DELETEDTXNS)
				{
					$xml .= '<DeletedDateRangeFilter>' . "\n";
					$xml .= '	<FromDeletedDate>' . $prev_sync_datetime . '</FromDeletedDate>' . "\n";
					$xml .= '</DeletedDateRangeFilter>' . "\n";
				}
				else
				{
					$xml .= '<ModifiedDateRangeFilter>' . "\n";
					$xml .= '	<FromModifiedDate>' . $prev_sync_datetime . '</FromModifiedDate>' . "\n";
					$xml .= '</ModifiedDateRangeFilter>' . "\n";
				}
			}
			else
			{
				$xml .= '<FromModifiedDate>' . $prev_sync_datetime . '</FromModifiedDate>';
			}
		}
		else 	// ... otherwise use what we found in previous time stamp
		{
			if ($filter_wrap)
			{
				if ($action == QUICKBOOKS_QUERY_DELETEDLISTS or $action == QUICKBOOKS_QUERY_DELETEDTXNS)
				{
					$xml .= '<DeletedDateRangeFilter>' . "\n";
					$xml .= '	<FromDeletedDate>' . $prev_sync_datetime . '</FromDeletedDate>' . "\n";
					$xml .= '</DeletedDateRangeFilter>' . "\n";
				}
				else
				{
					$xml .= '<ModifiedDateRangeFilter>' . "\n";
					$xml .= '	<FromModifiedDate>' . $prev_sync_datetime . '</FromModifiedDate>' . "\n";
					$xml .= '</ModifiedDateRangeFilter>' . "\n";
				}
			}
			else
			{
				$xml .= '<FromModifiedDate>' . $prev_sync_datetime . '</FromModifiedDate>';
			}
		}
		
		return $xml;
	}