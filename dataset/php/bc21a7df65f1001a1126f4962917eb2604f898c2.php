public static function deleteUser($listid,$email)
    {
     	$email=md5($email);
    	$action = self::$api_version.'/lists/'.$listid.'/members/'. $email;
    	return self::send($action, 'DELETE', []);
    }