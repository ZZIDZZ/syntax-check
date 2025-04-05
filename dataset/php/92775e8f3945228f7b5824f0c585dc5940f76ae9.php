private function createJs()
    {
    	$nodes = $this->_workflow->getAllStatuses();
    	$trList = [];
    	$nodeList = [];
    	foreach($nodes as $node) {
    		$n = new \stdClass();
    		$n->id = $node->getId();
    		$n->label = $node->getLabel();
    		if( $node->getMetadata('color') ){
    			if( $node->getWorkflow()->getInitialStatusId() == $node->getId() ){
    				$n->borderWidth = 4;
    				$n->color = new \stdClass();
    				$n->color->border = 'rgb(0,255,42)';
    				// 	$n->color->background = $node->getMetadata('color');
    			} else {
    				//	$n->color = $node->getMetadata('color');
    			}
    		}
    		$nodeList[] = $n;
    	
    		$transitions = $node->getTransitions();
    		foreach($transitions as $transition){
    			$t = new \stdClass();
    			$t->from = $n->id;
    			$t->to = $transition->getEndStatus()->getId();
    			$t->arrows = 'to';
    			$trList[] = $t;
    		}
    	}
    	$jsonNodes = \yii\helpers\Json::encode($nodeList);
    	$jsonTransitions = \yii\helpers\Json::encode($trList);
   	
    	$js=<<<EOS
		var {$this->visNetworkId} = new vis.Network(
			document.getElementById('{$this->containerId}'), 
	    	{
			    nodes: new vis.DataSet($jsonNodes),
			    edges: new vis.DataSet($jsonTransitions)
		  	}, 
	    	{				    			    	
				"physics": {
					"solver": "repulsion"
				}
			}
	    );

EOS;
    	return $js;   
    }