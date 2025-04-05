public function getParents($includeSelf = true)
    {
        $parents = array();

        if ($includeSelf) {
            $parents[$this->owner->{$this->idAttribute}] = $this->owner;
        }

        // Try and find a parent
        $parent = $this->getParent();
        if ($parent instanceof CActiveRecord) {
            $parents[$parent->{$this->idAttribute}] = $parent;

            // Fetch any additional ancestry levels
            while ($nextParent = $parent->getParent()) {
                $parents[$nextParent->{$this->idAttribute}] = $nextParent;
                $parent = $nextParent;
            }
        }

        return array_reverse($parents, true);
    }