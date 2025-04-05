def rotatePoint(self, pointX, pointY):
        """
        Rotates a point relative to the mesh origin by the angle specified in the angle property.
        Uses the angle formed between the segment linking the point of interest to the origin and
        the parallel intersecting the origin. This angle is called beta in the code.
        """    
        if(self.angle == 0 or self.angle == None):
            return(pointX, pointY)
              
        # 1. Compute the segment length
        length = math.sqrt((pointX - self.xll) ** 2 + (pointY - self.yll) ** 2)
        
        # 2. Compute beta
        beta = math.acos((pointX - self.xll) / length) 
        if(pointY < self.yll):
            beta = math.pi * 2 - beta
           
        # 3. Compute offsets
        offsetX = math.cos(beta) * length - math.cos(self._angle_rd + beta) * length
        offsetY = math.sin(self._angle_rd + beta) * length - math.sin(beta) * length 
        return (pointX - offsetX, pointY + offsetY)