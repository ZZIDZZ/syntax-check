def decode(self, packet):
        '''
        Decode a PUBREL control packet. 
        '''
        self.encoded = packet
        lenLen = 1
        while packet[lenLen] & 0x80:
            lenLen += 1
        packet_remaining = packet[lenLen+1:]
        self.msgId  = decode16Int(packet_remaining)
        self.dup = (packet[0] & 0x08) == 0x08