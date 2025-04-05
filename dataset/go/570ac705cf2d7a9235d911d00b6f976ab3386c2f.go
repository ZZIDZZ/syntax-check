func (dom *Domain) MailingLists() ([]*MailingList, error) {
	var vl valueList
	err := dom.cgp.request(listLists{Domain: dom.Name}, &vl)
	if err != nil {
		return []*MailingList{}, err
	}
	vals := vl.compact()
	mls := make([]*MailingList, len(vals))
	for i, v := range vals {
		mls[i] = dom.MailingList(v)
	}
	return mls, nil
}