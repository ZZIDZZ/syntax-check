public static function display($name = null, $round = 3)
    {
        $time = round(static::get($name), $round);
        $name = ($name === null ? 'GLOBAL' : $name);

        if (PHP_SAPI !== 'cli') {
            echo '
<div style="background-color: #99CCCC">
    <strong>Timer[' . $name . ']: </strong> ' . $time . ' s
</div>';
        } else {
            echo ' ### Timer[' . $name . ']: ' . $time . 's ###' . PHP_EOL;
        }
    }