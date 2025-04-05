def accept_EP_PKG(self, inst):
        '''
        A Package contains packageable elements
        '''
        for child in many(inst).PE_PE[8000]():
            self.accept(child)