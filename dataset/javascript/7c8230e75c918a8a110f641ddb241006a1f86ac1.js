function smtpGetEmailInfoById(callback,id){
    if ((id===undefined)||(! id.length)) {
        return callback(returnError('Empty id'));
    }
    sendRequest( 'smtp/emails/' + id, 'GET', {}, true, callback );
}