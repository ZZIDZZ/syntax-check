public function find($fromClassName, $toClassName)
    {
        $annotations = array();

        $graph = new Graph();

        $this->createEdges($graph, $fromClassName);
        $this->createEdges($graph, $toClassName);

        try {
            $breadFirst = new BreadthFirst($graph->getVertex($fromClassName));
            $edges = $breadFirst->getEdgesTo($graph->getVertex($toClassName));
            /** @var Directed $edge */
            foreach ($edges as $edge) {
                $annotations[] = $this->annotations[$this->getEdgeId($edge)];
            }
        } catch (OutOfBoundsException $e) {
            return null;
        }

        return $annotations;
    }