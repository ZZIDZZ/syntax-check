final public static function getAlignedPos(\ManiaLib\Gui\Element $object,
                                               $newHalign, $newValign)
    {
        $newPosX = self::getAlignedPosX(
            $object->getPosX(), $object->getRealSizeX(), $object->getHalign(),
            $newHalign);
        $newPosY = self::getAlignedPosY(
            $object->getPosY(), $object->getRealSizeY(), $object->getValign(),
            $newValign);
        return array('x' => $newPosX, 'y' => $newPosY);
    }