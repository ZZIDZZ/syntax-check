protected function writeItem($item, WriterPipe $pipe)
    {
        if ($pipe->getFilter() === null || $pipe->getFilter()->filter($item) === true) {
            $pipe->getWriter()->writeItem($item);

            return true;
        }

        return false;
    }