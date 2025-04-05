def delete(self, *args, **kwargs):
        """
        Deletes the video from youtube

        Raises:
            OperationError
        """
        api = Api()

        # Authentication is required for deletion
        api.authenticate()

        # Send API request, raises OperationError on unsuccessful deletion
        api.delete_video(self.video_id)

        # Call the super method
        return super(Video, self).delete(*args, **kwargs)