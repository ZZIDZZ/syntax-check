function RESTResponse(url, method, body) {
  /** The original request. */
  this.request = {
    url: url,
    method: method
  };
  /** The body of the response. */
  this.body = body || "";
  /** Status of the response. */
  this.status = "200";
}