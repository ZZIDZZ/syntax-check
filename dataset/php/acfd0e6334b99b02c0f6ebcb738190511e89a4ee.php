public function block()
    {
        $request = Registry::getRequest();
        $data = $request->getRequestParameter('data');
        DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC)->execute(
        "UPDATE oxtplblocks SET OXACTIVE = NOT OXACTIVE WHERE OXID = ?",[$data]);
    }