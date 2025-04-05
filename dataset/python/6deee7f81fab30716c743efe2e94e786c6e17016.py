def resize_image_to_fit_width(image, dest_w):
    """
    Resize and image to fit the passed in width, keeping the aspect ratio the same

    :param image: PIL.Image
    :param dest_w: The desired width
    """
    scale_factor = dest_w / image.size[0]
    dest_h = image.size[1] * scale_factor
    
    scaled_image = image.resize((int(dest_w), int(dest_h)), PIL.Image.ANTIALIAS)

    return scaled_image