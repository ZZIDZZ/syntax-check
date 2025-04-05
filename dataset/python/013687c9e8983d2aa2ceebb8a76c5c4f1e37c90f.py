def _draw_mainlayer(self, gc, view_bounds=None, mode="default"):
        """ Draws the Bezier component """

        if not self.points: return
        gc.save_state()
        try:
            gc.set_fill_color(self.pen.fill_color_)

            gc.set_line_width(self.pen.line_width)
            gc.set_stroke_color(self.pen.color_)

            gc.begin_path()
            start_x, start_y = self.points[0]
            gc.move_to(start_x, start_y)
            for triple in nsplit(self.points[1:], 3):
                x1, y1 = triple[0]
                x2, y2 = triple[1]
                end_x, end_y = triple[2]
                gc.curve_to(x1, y1, x2, y2, end_x, end_y)
                # One point overlap
                gc.move_to(end_x, end_y)
            gc.stroke_path()
        finally:
            gc.restore_state()