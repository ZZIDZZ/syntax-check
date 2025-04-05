def set_humidity(self, index, humidity):
        ''' Set humidity level'''
        body = {"selection": {"selectionType": "thermostats",
                              "selectionMatch": self.thermostats[index]['identifier']},
                              "thermostat": {
                                  "settings": {
                                      "humidity": int(humidity)
                                  }
                              }}

        log_msg_action = "set humidity level"
        return self.make_request(body, log_msg_action)