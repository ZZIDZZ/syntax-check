public function resolved(string $id): bool
    {
        if (!$this->has($id)) {
            throw new class extends \LogicException implements NotFoundExceptionInterface {};
        }

        return !$this->container[$id] instanceof \Closure;
    }