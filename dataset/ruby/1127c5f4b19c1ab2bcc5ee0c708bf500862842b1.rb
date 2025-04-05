def notice_signal(signal)
      Thread.new do
        Karafka.monitor.instrument('process.notice_signal', caller: self, signal: signal)
      end
    end