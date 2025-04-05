def hflip_detections(label, w):
    """
    Horizontally flip detections according to an image flip.

    :param label: The label dict containing all detection lists.
    :param w: The width of the image as a number.
    :return:
    """
    for k in label.keys():
        if k.startswith("detection"):
            detections = label[k]
            for detection in detections:
                detection.cx = w - detection.cx
                if k == "detections_2.5d":
                    detection.theta = math.pi - detection.theta