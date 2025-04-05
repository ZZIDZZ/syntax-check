public BookmarkListResponse getBookmarks(String bookmarkType, String groupKey, String sharingType) throws ApiException {
    Object localVarPostBody = null;
    
    // verify the required parameter 'bookmarkType' is set
    if (bookmarkType == null) {
      throw new ApiException(400, "Missing the required parameter 'bookmarkType' when calling getBookmarks");
    }
    
    // create path and map variables
    String localVarPath = "/bookmarks".replaceAll("\\{format\\}","json");

    // query params
    List<Pair> localVarQueryParams = new ArrayList<Pair>();
    Map<String, String> localVarHeaderParams = new HashMap<String, String>();
    Map<String, Object> localVarFormParams = new HashMap<String, Object>();

    localVarQueryParams.addAll(apiClient.parameterToPairs("", "bookmarkType", bookmarkType));
    localVarQueryParams.addAll(apiClient.parameterToPairs("", "groupKey", groupKey));
    localVarQueryParams.addAll(apiClient.parameterToPairs("", "sharingType", sharingType));

    
    
    final String[] localVarAccepts = {
      "application/json"
    };
    final String localVarAccept = apiClient.selectHeaderAccept(localVarAccepts);

    final String[] localVarContentTypes = {
      "application/json"
    };
    final String localVarContentType = apiClient.selectHeaderContentType(localVarContentTypes);

    String[] localVarAuthNames = new String[] { "token" };

    GenericType<BookmarkListResponse> localVarReturnType = new GenericType<BookmarkListResponse>() {};
    return apiClient.invokeAPI(localVarPath, "GET", localVarQueryParams, localVarPostBody, localVarHeaderParams, localVarFormParams, localVarAccept, localVarContentType, localVarAuthNames, localVarReturnType);
      }