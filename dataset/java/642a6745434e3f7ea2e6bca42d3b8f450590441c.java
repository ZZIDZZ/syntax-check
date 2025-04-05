public boolean sendDelayMsg(String topic, String tag, Message msg, int delayLevel) {
        msg.setDelayTimeLevel(delayLevel);
        SendResult sendResult = null;
        try {
            sendResult = producer.send(msg);
        } catch (Exception e) {
            logger.error("send msg error", e);
        }
        return sendResult != null && sendResult.getSendStatus() == SendStatus.SEND_OK;
    }