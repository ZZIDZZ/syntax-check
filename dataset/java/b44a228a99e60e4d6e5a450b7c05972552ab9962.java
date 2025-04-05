private void completeMultiUpload(String objectKey, String fileName, String eTag, String uploadID, long length) throws QSException {
        CompleteMultipartUploadInput completeMultipartUploadInput =
                new CompleteMultipartUploadInput(uploadID, partCounts, 0);

        completeMultipartUploadInput.setContentLength(length);

        // Set content disposition to the object.
        if (!QSStringUtil.isEmpty(fileName)) {
            try {
                String keyName = QSStringUtil.percentEncode(fileName, "UTF-8");
                completeMultipartUploadInput.setContentDisposition(String.format(
                        "attachment; filename=\"%s\"; filename*=utf-8''%s", keyName, keyName));
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }
        }

        // Set the Md5 info to the object.
        if (!QSStringUtil.isEmpty(eTag)) {
            completeMultipartUploadInput.setETag(eTag);
        }

        RequestHandler requestHandler =
                bucket.completeMultipartUploadRequest(objectKey, completeMultipartUploadInput);

        sign(requestHandler);

        Bucket.CompleteMultipartUploadOutput send =
                (Bucket.CompleteMultipartUploadOutput) requestHandler.send();

        if (send.getStatueCode() == 200 || send.getStatueCode() == 201) {
            uploadModel.setUploadComplete(true);
            setData(objectKey, recorder);
        }

        // Response callback.
        if (callBack != null)
            callBack.onAPIResponse(objectKey, send);
    }