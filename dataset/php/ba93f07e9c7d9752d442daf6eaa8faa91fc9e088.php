private static function getPaths($key){
    	$paths = array();
    	$sourcePaths = explode(".", $key);
    	foreach ($sourcePaths as $sourcePath){
    		$subPaths = preg_split('/\[(.*?)\]/',$sourcePath,-1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
    		if($subPaths !== FALSE){
    			$paths = array_merge($paths,$subPaths);
    		}
    	}
    	return $paths;
    }