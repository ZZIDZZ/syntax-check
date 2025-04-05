public static function getSoapControllers(){

        $modules = jApp::config()->_modulesPathList;
        $controllers = array();

        foreach($modules as $module){
            if(is_dir($module.'controllers')){
                if ($handle = opendir($module.'controllers')) {
                    $moduleName = basename($module);
                    while (false !== ($file = readdir($handle))) {
                        if (substr($file, strlen($file) - strlen('.soap.php')) == '.soap.php') {
                            $controller = array();
                            $controller['class'] = substr($file, 0, strlen($file) - strlen('.soap.php'));
                            $controller['module'] = $moduleName;
                            $controller['service'] = $moduleName.'~'.$controller['class'];
                            array_push($controllers, $controller);
                        }
                    }
                    closedir($handle);
                }
            }
        }
        return $controllers;
    }