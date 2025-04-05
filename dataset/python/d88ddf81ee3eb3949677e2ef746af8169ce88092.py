def from_grayscale(im, channels_on=(True, True, True)):
        """Return a canvas from a grayscale image.

        :param im: single channel image
        :channels_on: channels to populate with input image
        :returns: :class:`jicbioimage.illustrate.Canvas`
        """
        xdim, ydim = im.shape
        canvas = np.zeros((xdim, ydim, 3), dtype=np.uint8)
        for i, include in enumerate(channels_on):
            if include:
                canvas[:, :, i] = im
        return canvas.view(AnnotatedImage)