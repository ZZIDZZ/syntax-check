def _draw(self):
        """ Don't use this, use document.draw_table """
        self._compile()
        self.rows[0]._advance_first_row()
        self._set_borders()
        self._draw_fill()
        self._draw_borders()
        self._draw_text()
        self._set_final_cursor()