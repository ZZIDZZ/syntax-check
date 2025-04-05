function finalizeResourceType(resourceType = "image", type = "upload", urlSuffix, useRootPath, shorten) {
  var options;
  resourceType = resourceType == null ? "image" : resourceType;
  type = type == null ? "upload" : type;
  if (isPlainObject(resourceType)) {
    options = resourceType;
    resourceType = options.resource_type;
    type = options.type;
    urlSuffix = options.url_suffix;
    useRootPath = options.use_root_path;
    shorten = options.shorten;
  }
  if (type == null) {
    type = 'upload';
  }
  if (urlSuffix != null) {
    resourceType = SEO_TYPES[`${resourceType}/${type}`];
    type = null;
    if (resourceType == null) {
      throw new Error(`URL Suffix only supported for ${Object.keys(SEO_TYPES).join(', ')}`);
    }
  }
  if (useRootPath) {
    if (resourceType === 'image' && type === 'upload' || resourceType === "images") {
      resourceType = null;
      type = null;
    } else {
      throw new Error("Root path only supported for image/upload");
    }
  }
  if (shorten && resourceType === 'image' && type === 'upload') {
    resourceType = 'iu';
    type = null;
  }
  return [resourceType, type].join("/");
}