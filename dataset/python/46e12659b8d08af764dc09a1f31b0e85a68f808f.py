def sweep(self, min_freq, max_freq, bins, repeats, runs=0, time_limit=0, overlap=0,
              fft_window='hann', fft_overlap=0.5, crop=False, log_scale=True, remove_dc=False, detrend=None, lnb_lo=0,
              tune_delay=0, reset_stream=False, base_buffer_size=0, max_buffer_size=0, max_threads=0, max_queue_size=0):
        """Sweep spectrum using frequency hopping"""
        self.setup(
            bins, repeats, base_buffer_size, max_buffer_size,
            fft_window=fft_window, fft_overlap=fft_overlap, crop_factor=overlap if crop else 0,
            log_scale=log_scale, remove_dc=remove_dc, detrend=detrend, lnb_lo=lnb_lo, tune_delay=tune_delay,
            reset_stream=reset_stream, max_threads=max_threads, max_queue_size=max_queue_size
        )

        try:
            freq_list = self.freq_plan(min_freq - lnb_lo, max_freq - lnb_lo, bins, overlap)
            t_start = time.time()
            run = 0
            while not _shutdown and (runs == 0 or run < runs):
                run += 1
                t_run_start = time.time()
                logger.debug('Run: {}'.format(run))

                for freq in freq_list:
                    # Tune to new frequency, acquire samples and compute Power Spectral Density
                    psd_future, acq_time_start, acq_time_stop = self.psd(freq)

                    # Write PSD to stdout (in another thread)
                    self._writer.write_async(psd_future, acq_time_start, acq_time_stop,
                                             len(self._buffer) * self._buffer_repeats)

                    if _shutdown:
                        break

                # Write end of measurement marker (in another thread)
                write_next_future = self._writer.write_next_async()
                t_run = time.time()
                logger.debug('  Total run time: {:.3f} s'.format(t_run - t_run_start))

                # End measurement if time limit is exceeded
                if time_limit and (time.time() - t_start) >= time_limit:
                    logger.info('Time limit of {} s exceeded, completed {} runs'.format(time_limit, run))
                    break

            # Wait for last write to be finished
            write_next_future.result()

            # Debug thread pool queues
            logging.debug('Number of USB buffer overflow errors: {}'.format(self.device.buffer_overflow_count))
            logging.debug('PSD worker threads: {}'.format(self._psd._executor._max_workers))
            logging.debug('Max. PSD queue size: {} / {}'.format(self._psd._executor.max_queue_size_reached,
                                                                self._psd._executor.max_queue_size))
            logging.debug('Writer worker threads: {}'.format(self._writer._executor._max_workers))
            logging.debug('Max. Writer queue size: {} / {}'.format(self._writer._executor.max_queue_size_reached,
                                                                   self._writer._executor.max_queue_size))
        finally:
            # Shutdown SDR
            self.stop()
            t_stop = time.time()
            logger.info('Total time: {:.3f} s'.format(t_stop - t_start))