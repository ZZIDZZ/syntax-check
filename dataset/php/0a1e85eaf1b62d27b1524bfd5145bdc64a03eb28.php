public static function makeTree(\Illuminate\Database\Eloquent\Collection $collection, \Closure $map = null)
    {
        if (is_callable($map)) {
            $collection->map($map);
        }

        $categories = $collection->keyBy('id')->toArray();

        $nodesKey = (new static)->getNodesKey();

        foreach($categories as $cate) {
            $categories[$cate['parent_id']][$nodesKey][] = & $categories[$cate['id']];
        }

        return isset($categories[0][$nodesKey]) ? $categories[0][$nodesKey] : [];
    }