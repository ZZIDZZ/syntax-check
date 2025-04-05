public function getActionsToRender($row)
    {
        $list = $this->rowActions;
        foreach ($list as $i => $a) {
            $action = clone $a;
            $list[$i] = $action->render($row);
            if (null === $list[$i]) {
                unset($list[$i]);
            }
        }

        return $list;
    }