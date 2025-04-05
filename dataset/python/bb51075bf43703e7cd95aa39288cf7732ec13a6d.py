def check_dict(self, opt, value):
    '''Take json as dictionary parameter'''
    try:
      return json.loads(value)
    except:
      raise optparse.OptionValueError("Option %s: invalid dict value: %r" % (opt, value))