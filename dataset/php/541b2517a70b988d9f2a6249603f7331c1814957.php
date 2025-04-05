public function move($x, $y) {
      if (!$this->up) {
        $x1 = round($this->x);
        $y1 = round($this->y);
        $x2 = $x;
        $y2 = $y;

        $xdiff = max($x1, $x2) - min($x1, $x2);
        $ydiff = max($y1, $y2) - min($y1, $y2);

        $xdir = $x1 <= $x2 ? 1 : -1;
        $ydir = $y1 <= $y2 ? 1 : -1;

        $r = max($xdiff, $ydiff);

        for ($i = 0; $i <= $r; $i++) {
            $x = $x1;
            $y = $y1;

            if ($ydiff > 0) {
                $y += ((float)$i * $ydiff) / $r * $ydir;
            }

            if ($xdiff > 0) {
                $x += ((float)$i * $xdiff) / $r * $xdir;
            }

            $this->set($x, $y);
        }
      }

      $this->x = $x;
      $this->y = $y;
    }