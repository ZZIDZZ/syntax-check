public function isSatisfiedBy(GroupItem $item)
    {
        $field_name = $this->field_name;

        if(in_array($item->$field_name, $this->val)){
            return ($item->$field_name == $this->val);
        }else{
            return ($item->$field_name == $this->val);
        }
    }