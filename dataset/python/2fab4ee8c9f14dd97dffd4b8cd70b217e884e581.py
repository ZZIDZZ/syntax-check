def _send_reliable_message(self, msg):
        """Send msg to LightwaveRF hub."""
        result = False
        max_retries = 15
        trans_id = next(LWLink.transaction_id)
        msg = "%d,%s" % (trans_id, msg)
        try:
            with socket.socket(socket.AF_INET, socket.SOCK_DGRAM) \
                    as write_sock, \
                    socket.socket(socket.AF_INET, socket.SOCK_DGRAM) \
                    as read_sock:
                write_sock.setsockopt(
                    socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
                read_sock.setsockopt(socket.SOL_SOCKET,
                                     socket.SO_BROADCAST, 1)
                read_sock.settimeout(self.SOCKET_TIMEOUT)
                read_sock.bind(('0.0.0.0', self.RX_PORT))
                while max_retries:
                    max_retries -= 1
                    write_sock.sendto(msg.encode(
                        'UTF-8'), (LWLink.link_ip, self.TX_PORT))
                    result = False
                    while True:
                        response, dummy = read_sock.recvfrom(1024)
                        response = response.decode('UTF-8')
                        if "Not yet registered." in response:
                            _LOGGER.error("Not yet registered")
                            self.register()
                            result = True
                            break

                        if response.startswith("%d,OK" % trans_id):
                            result = True
                            break
                        if response.startswith("%d,ERR" % trans_id):
                            _LOGGER.error(response)
                            break

                        _LOGGER.info(response)

                    if result:
                        break

                    time.sleep(0.25)

        except socket.timeout:
            _LOGGER.error("LW broker timeout!")
            return result

        except Exception as ex:
            _LOGGER.error(ex)
            raise

        if result:
            _LOGGER.info("LW broker OK!")
        else:
            _LOGGER.error("LW broker fail!")
        return result