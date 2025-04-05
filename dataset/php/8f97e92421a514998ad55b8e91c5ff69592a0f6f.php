public function render($name = null)
    {
        $args = func_get_args();
        $args[] = config('app.locale');

        return $this->executeCallback(static::class, __FUNCTION__, $args, function () use ($name) {
            $block = $this->prepareQuery($this->createModel())
                ->where('name', $name)
                ->published()
                ->first();

            return $block ? $block->present()->body : '';
        });
    }