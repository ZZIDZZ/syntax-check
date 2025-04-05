def call(job)
      args = job[:args]
      receiver_str, _, message = job[:method].rpartition('.')
      receiver = eval(receiver_str)
      receiver.send(message, *args)
    end