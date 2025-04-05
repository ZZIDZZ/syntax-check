protected function index()
    {

        $this->response->theme->asset()->container('footer')->add('gmap', 'https://maps.googleapis.com/maps/api/js?key=' . config('litecms.contact.gmapapi'));

        $contact = $this->repository
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->first();

        return $this->response->setMetaTitle(trans('contact::contact.names'))
            ->view('contact::index')
            ->populate(false)
            ->data(compact('contact'))
            ->output();
    }