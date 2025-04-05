public function getObjectsAction()
    {
        $qb = $this->getQueryBuilder();
        $qb->select(\CampaignChain\CoreBundle\Controller\REST\LocationController::SELECT_STATEMENT);
        $qb->from('CampaignChain\CoreBundle\Entity\Location', 'l');
        $qb->where('l.channel IS NULL');
        $qb->orderBy('l.name');
        $qb = $this->getModuleRelation($qb, 'l.locationModule', self::MODULE_URI);
        $qb = $this->getLocationChannelId($qb);
        $query = $qb->getQuery();

        return $this->response(
            $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY)
        );
    }