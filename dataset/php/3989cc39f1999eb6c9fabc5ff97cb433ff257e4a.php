public static function imageDominant($src, $granularity = 1)
  {
    $granularity = max(1, abs((int)$granularity));
    $channels = array(
      'red' => 0,
      'green' => 0,
      'blue' => 0
    );
    $size = @getimagesize($src);
    if ($size === false) {
      user_error("Unable to get image size data: ".$src);
      return false;
    }
    $img = @imagecreatefromstring(@file_get_contents($src));
    if (!$img) {
      user_error("Unable to open image file: ".$src);
      return false;
    }
    for($x = 0; $x < $size[0]; $x += $granularity) {
      for($y = 0; $y < $size[1]; $y += $granularity) {
        $thisColor = imagecolorat($img, $x, $y);
        $rgb = imagecolorsforindex($img, $thisColor);
        $channels['red'] += $rgb['red'];
        $channels['green'] += $rgb['green'];
        $channels['blue'] += $rgb['blue'];
      }
    }
    $nbPixels = ceil($size[0] / $granularity) * ceil($size[1] / $granularity);
    $channels['red'] = round($channels['red'] / $nbPixels);
    $channels['green'] = round($channels['green'] / $nbPixels);
    $channels['blue'] = round($channels['blue'] / $nbPixels);
    return $channels;
  }