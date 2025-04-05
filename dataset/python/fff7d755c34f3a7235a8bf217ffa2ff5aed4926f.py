def _get_chunk(self, data, index):
        '''
        partition the data into chunks and retrieve the chunk at the given index
        '''
        return data[index*self.chunklen[0]:(index+1)*self.chunklen[0]]