function popupWithPost(url, postData, name, options, callback) {
    function openWithPostData(popupUrl, popupName, optionsString) {
        return openPopupWithPost(popupUrl, postData, popupName, optionsString);
    }

    return popupExecute(openWithPostData, url, name, options, callback);
}