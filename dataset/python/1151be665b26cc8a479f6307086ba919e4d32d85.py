def getSize(self):
        """
        Returns the size of the layer, with the border size already subtracted.
        """
        return self.widget.size[0]-self.border[0]*2,self.widget.size[1]-self.border[1]*2