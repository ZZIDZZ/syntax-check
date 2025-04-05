function getPayload(token) {
  const payloadBase64 = token
    .split(".")[1]
    .replace("-", "+")
    .replace("_", "/");
  const payloadDecoded = base64.decode(payloadBase64);
  const payloadObject = JSON.parse(payloadDecoded);

  if (AV.isNumber(payloadObject.exp)) {
    payloadObject.exp = new Date(payloadObject.exp * 1000);
  }

  return payloadObject;
}