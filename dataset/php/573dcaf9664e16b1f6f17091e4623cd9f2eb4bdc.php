public static function getService($service, $new = 0)
    {
        $defaultPackage = "service";
        $serviceName = $service;
        if (strpos($service, ".") === false) {
            $serviceName = $defaultPackage . "." . $service;
        }
        return Openbizx::getObject($serviceName, $new);
    }