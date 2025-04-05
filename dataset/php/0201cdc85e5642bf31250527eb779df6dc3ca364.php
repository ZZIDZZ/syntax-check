private function getQualifiedPivotTableName(string $class=null): string
    {
        /** @var \Cviebrock\EloquentTaggable\Taggable $instance */
        $instance = $class ? new $class : new class extends Model { use Taggable; };

        return $instance->tags()->getConnection()->getTablePrefix() .
                $instance->tags()->getTable();
    }