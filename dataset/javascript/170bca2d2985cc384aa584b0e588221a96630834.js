function newRequest(req, res, session, cb){

    const now = new Date();

    const request = {
        _id: `r${crypto.randomBytes(16).toString('hex')}${Date.now()}`,
        host: req.hostname,
        url: req.url,
        method: req.method,
        referrer: req.get('Referrer') || req.get('Referer')
    };

    // populate request query
    for(let field in req.query){
        if(field === 'ref')
            request.ref = req.query[field];
        else {
            if(!request.query)
                request.query = [];

            request.query.push({
                field: field,
                value: req.query[field]
            })
        }
    }

    // add request cookie for communication/association with socket
    res.cookie('na_req', AES.encrypt(request._id), {
        maxAge:     1000 * 60 * 15,             // 15 mins
        httpOnly:   true,
        secure:     opts.secure
    });


    // return request object: will be added at sessionSave();
    cb(null, req, res, session, request);


    if(opts.log_all)
        log.timer('newRequest', now);
}