private function getContentType($path) {
        $result = false;
        if (is_file($path) === true) {
            if (function_exists('finfo_open') === true) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if (is_resource($finfo) === true) {
                    $result = finfo_file($finfo, $path);
                }
                finfo_close($finfo);
            } else if (function_exists('mime_content_type') === true) {
                $result = preg_replace('~^(.+);.*$~', '$1', mime_content_type($path));
            } else if (function_exists('exif_imagetype') === true) {
                $result = image_type_to_mime_type(exif_imagetype($path));
            }
        }
        return $result;
    }