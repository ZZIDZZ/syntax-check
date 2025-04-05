public function getOutboundEdges($model, $label = null, $aql = "", $params = array(), $placeholder = "doc")
    {
        $id = $this->getVertexId($model);

        if (!$id) {
            return array();
        }

        $collectionParameter = $this->_toolbox->generateBindingParameter('@collection', $params);
        $vertexParameter = $this->_toolbox->generateBindingParameter('vertexid', $params);
        $directionParameter = $this->_toolbox->generateBindingParameter('direction', $params);

        if (!$label) {
            $query = "FOR $placeholder in EDGES(@$collectionParameter, @$vertexParameter, @$directionParameter) " . $aql . " return $placeholder";
        } else {
            $labelParameter = $this->_toolbox->generateBindingParameter('label', $params);
            $params[$labelParameter] = $label;
            $query = "FOR $placeholder in EDGES(@$collectionParameter, @$vertexParameter, @$directionParameter, [{'\$label': @$labelParameter}]) " . $aql . " return $placeholder";
        }

        $params[$collectionParameter] = $this->_toolbox->getEdgeCollectionName();
        $params[$vertexParameter] = $id;
        $params[$directionParameter] = "outbound";

        if ($this->_toolbox->getTransactionManager()->hasTransaction()) {
            $this->_toolbox->getTransactionManager()->addReadCollection($this->_toolbox->getEdgeCollectionName());
            $statement = json_encode(array('query' => $query, 'bindVars' => $params), JSON_FORCE_OBJECT);
            $this->_toolbox->getTransactionManager()->addCommand("db._createStatement($statement).execute().elements();", "GraphManager:getOutboundEdges", null, true);

        } else {
            try {
                $result = $this->_toolbox->getQuery()->getAll($query, $params);
            } catch (\Exception $e) {
                throw new GraphManagerException($e->getMessage(), $e->getCode());
            }

            if (empty($result)) {
                return array();
            }

            return $this->convertToPods("edge", $result);
        }
    }