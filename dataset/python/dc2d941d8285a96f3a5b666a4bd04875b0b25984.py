def ensure_running(self):
        '''Make sure that semaphore tracker process is running.

        This can be run from any process.  Usually a child process will use
        the semaphore created by its parent.'''
        with self._lock:
            if self._fd is not None:
                # semaphore tracker was launched before, is it still running?
                if self._check_alive():
                    # => still alive
                    return
                # => dead, launch it again
                os.close(self._fd)
                try:
                    # Clean-up to avoid dangling processes.
                    os.waitpid(self._pid, 0)
                except OSError:
                    # The process was terminated or is a child from an ancestor
                    # of the current process.
                    pass
                self._fd = None
                self._pid = None

                warnings.warn('semaphore_tracker: process died unexpectedly, '
                              'relaunching.  Some semaphores might leak.')

            fds_to_pass = []
            try:
                fds_to_pass.append(sys.stderr.fileno())
            except Exception:
                pass

            r, w = os.pipe()
            cmd = 'from {} import main; main({}, {})'.format(
                main.__module__, r, VERBOSE)
            try:
                fds_to_pass.append(r)
                # process will out live us, so no need to wait on pid
                exe = spawn.get_executable()
                args = [exe] + util._args_from_interpreter_flags()
                # In python 3.3, there is a bug which put `-RRRRR..` instead of
                # `-R` in args. Replace it to get the correct flags.
                # See https://github.com/python/cpython/blob/3.3/Lib/subprocess.py#L488
                if sys.version_info[:2] <= (3, 3):
                    import re
                    for i in range(1, len(args)):
                        args[i] = re.sub("-R+", "-R", args[i])
                args += ['-c', cmd]
                util.debug("launching Semaphore tracker: {}".format(args))
                # bpo-33613: Register a signal mask that will block the
                # signals.  This signal mask will be inherited by the child
                # that is going to be spawned and will protect the child from a
                # race condition that can make the child die before it
                # registers signal handlers for SIGINT and SIGTERM. The mask is
                # unregistered after spawning the child.
                try:
                    if _HAVE_SIGMASK:
                        signal.pthread_sigmask(signal.SIG_BLOCK,
                                               _IGNORED_SIGNALS)
                    pid = spawnv_passfds(exe, args, fds_to_pass)
                finally:
                    if _HAVE_SIGMASK:
                        signal.pthread_sigmask(signal.SIG_UNBLOCK,
                                               _IGNORED_SIGNALS)
            except BaseException:
                os.close(w)
                raise
            else:
                self._fd = w
                self._pid = pid
            finally:
                os.close(r)