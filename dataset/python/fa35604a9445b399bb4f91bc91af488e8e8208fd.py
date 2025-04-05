def _encode_fields(self, xfield, yfield, time_unit=None,
                       scale=Scale(zero=False)):
        """
        Encode the fields in Altair format
        """
        if scale is None:
            scale = Scale()
        xfieldtype = xfield[1]
        yfieldtype = yfield[1]
        x_options = None
        if len(xfield) > 2:
            x_options = xfield[2]
        y_options = None
        if len(yfield) > 2:
            y_options = yfield[2]
        if time_unit is not None:
            if x_options is None:
                xencode = X(xfieldtype, timeUnit=time_unit)
            else:
                xencode = X(
                    xfieldtype,
                    axis=Axis(**x_options),
                    timeUnit=time_unit,
                    scale=scale
                )
        else:
            if x_options is None:
                xencode = X(xfieldtype)
            else:
                xencode = X(
                    xfieldtype,
                    axis=Axis(**x_options),
                    scale=scale
                )
        if y_options is None:
            yencode = Y(yfieldtype, scale=scale)
        else:
            yencode = Y(
                yfieldtype,
                axis=Axis(**y_options),
                scale=scale
            )
        return xencode, yencode