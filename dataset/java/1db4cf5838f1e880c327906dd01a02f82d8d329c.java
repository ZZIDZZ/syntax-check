public void transmitAll(JSONObject message){
        List<PnPeer> peerList = this.pcClient.getPeers();
        for(PnPeer p : peerList){
            transmit(p.getId(), message);
        }
    }