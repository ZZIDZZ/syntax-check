public function deserializeRequest($className)
    {
        $request = $this->app["request_stack"]->getCurrentRequest();

        return $this->app["serializer"]->deserialize(
            $request->getContent(),
            $className,
            $request->getContentType(),
            $this->app["conneg.deserializationContext"]
        );
    }