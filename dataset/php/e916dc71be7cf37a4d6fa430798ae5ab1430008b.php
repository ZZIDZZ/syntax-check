protected function applySiteConditions()
    {
        if ($this->siteId !== null) {
            $this->andWhere(Db::parseParam('siteId', $this->siteId));
        } else {
            $this->andWhere(Db::parseParam('siteId', Craft::$app->getSites()->currentSite->id));
        }
    }