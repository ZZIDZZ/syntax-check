def update(self):
        """Update cameras and motion settings with latest from API."""
        cameras = self._api.camera_list()
        self._cameras_by_id = {v.camera_id: v for i, v in enumerate(cameras)}

        motion_settings = []
        for camera_id in self._cameras_by_id.keys():
            motion_setting = self._api.camera_event_motion_enum(camera_id)
            motion_settings.append(motion_setting)

        self._motion_settings_by_id = {
            v.camera_id: v for i, v in enumerate(motion_settings)}