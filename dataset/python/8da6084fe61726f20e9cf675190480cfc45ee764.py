def save_thumbnail(self, image, size, name, label, file_type):
        """Processes and saves a resized thumbnail version of the image."""
        width, height = size
        (imw, imh) = image.size

        # If image is larger than thumbnail size, resize image
        if (imw > width) or (imh > height):
            image.thumbnail(size, Img.ANTIALIAS)

        # Attach new thumbnail label to image filename
        name = "%s-%s.jpg" % (name, label)

        # Image.save format takes JPEG not jpg
        if file_type in self.JPG_FORMATS:
            file_type = 'JPEG'

        # Write new thumbnail to StringIO object
        image_io = StringIO.StringIO()
        image.save(image_io, format=file_type, quality=75)

        # Convert StringIO object to Django File object
        thumb_file = InMemoryUploadedFile(image_io, None, name, 'image/jpeg', image_io.len, None)

        # Save the new file to the default storage system
        default_storage.save(name, thumb_file)