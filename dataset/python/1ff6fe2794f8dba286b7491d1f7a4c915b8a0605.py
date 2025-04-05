def results(self):
        """Obtain the set of currently present streams on the network.

        Returns a list of matching StreamInfo objects (with empty desc
        field), any of which can subsequently be used to open an inlet.

        """
        # noinspection PyCallingNonCallable
        buffer = (c_void_p*1024)()
        num_found = lib.lsl_resolver_results(self.obj, byref(buffer), 1024)
        return [StreamInfo(handle=buffer[k]) for k in range(num_found)]