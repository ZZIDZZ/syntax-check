def _height_is_big_enough(image, height):
    """Check that the image height is superior to `height`"""
    if height > image.size[1]:
        raise ImageSizeError(image.size[1], height)