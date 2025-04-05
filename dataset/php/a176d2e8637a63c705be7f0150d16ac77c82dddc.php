public function addIcon($row, $label, \DataContainer $dc, $args)
	{
		$image = 'member';

		$time = \Date::floorToMinute();

		$disabled = $row['start'] !== '' && $row['start'] > $time || $row['stop'] !== '' && $row['stop'] < $time;

		if ($row['disable'] || $disabled)
		{
			$image .= '_';
		}
		
		$objUsers = \Database::getInstance()
		                    ->prepare("SELECT 
                                            tlm.id 
                                        FROM 
		                                    tl_member tlm, tl_beuseronline_session tls 
                                        WHERE 
		                                    tlm.id = tls.pid 
                                        AND tlm.id = ? 
                                        AND tls.tstamp > ? 
                                        AND tls.name = ?")
                            ->execute($row['id'], time()-300, 'FE_USER_AUTH');
		if ($objUsers->numRows < 1) 
		{
			//offline
			$status = sprintf('<img src="%ssystem/themes/%s/icons/invisible.svg" width="16" height="16" alt="Offline" style="padding-left: 18px;">', TL_ASSETS_URL, \Backend::getTheme());
		} 
		else 
		{
			//online
			$status = sprintf('<img src="%ssystem/themes/%s/icons/visible.svg" width="16" height="16" alt="Online" style="padding-left: 18px;">', TL_ASSETS_URL, \Backend::getTheme());
		}

		$args[0] = sprintf('<div class="list_icon_new" style="background-image:url(\'%ssystem/themes/%s/icons/%s.svg\'); width: 34px;" data-icon="%s.svg" data-icon-disabled="%s.svg">%s</div>', TL_ASSETS_URL, \Backend::getTheme(), $image, $disabled ? $image : rtrim($image, '_'), rtrim($image, '_') . '_', $status);
		
		return $args;
	}