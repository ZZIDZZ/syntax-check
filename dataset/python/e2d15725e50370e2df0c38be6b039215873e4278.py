def get_brightness(self):
        """
        Return the average brightness of the image.
        """
        # Only download the image if it has changed
        if not self.connection.has_changed():
            return self.image_brightness

        image_path = self.connection.download_image()

        converted_image = Image.open(image_path).convert('L')
        statistics = ImageStat.Stat(converted_image)

        self.image_brightness = statistics.mean[0]
        return self.image_brightness