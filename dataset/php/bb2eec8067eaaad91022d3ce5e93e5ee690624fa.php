public function postSectiontreeAction() {
        $serializer = $this->get("tpg_extjs.phpcr_serializer");
        $entity = $serializer->deserialize(
            $this->getRequest()->getContent(),
            'Application\Togu\ApplicationModelsBundle\Document\Section',
            'json',
            DeserializationContext::create()->setGroups(array("Default", "post"))
        );
		$modelLoader = $this->get('togu.generator.model.config');
		if(! $modelLoader->hasModel($entity->getType())) {
			throw new \InvalidArgumentException(sprintf('The model %s does not exist', $entity->getType()));
		}
        $validator = $this->get('validator');
        $validations = $validator->validate($entity, array('Default', 'post'));
        if ($validations->count() === 0) {
            $manager = $this->get('doctrine_phpcr.odm.default_document_manager');
            $rootData = $manager->find(null, '/data');

            $sectionClassName = $modelLoader->getFullClassName($entity->getType());
            $section = new $sectionClassName(array(
				"sectionConfig" => $entity,
            	"parentDocument" => $rootData
            ));
            $entity->getParentSection()->getSectionConfig()->addNextSection($section);
            $entity->getPage()->setSection($section);
            $manager->persist($entity);
            $manager->persist($section);
            try {
                $manager->flush();
            } catch (DBALException $e) {
                return $this->handleView(
                    View::create(array('errors'=>array($e->getMessage())), 400)
                );
            }
            return $this->handleView(
                View::create(array(
                	"success" => true,
                	"records" => array($entity)
                ), 200)->setSerializationContext($this->getSerializerContext(array('Default', 'post')))
            );
        } else {
            return $this->handleView(
                View::create(array('errors'=>$validations), 400)
            );
        }
    }