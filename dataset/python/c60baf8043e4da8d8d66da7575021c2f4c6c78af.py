def report(self, output_file=sys.stdout):
        """Report gathered analysis data in human readable form."""
        if self.verbose > 1:
            with pprint_nosort():
                pprint.pprint(self.results)

        if self.verbose > 0:
            print('Runtime (per repetition): {:.2g} s'.format(
                self.results['Runtime (per repetition) [s]']),
                file=output_file)
        if self.verbose > 0:
            print('Iterations per repetition: {!s}'.format(
                self.results['Iterations per repetition']),
                file=output_file)
        print('Runtime (per cacheline update): {:.2f} cy/CL'.format(
            self.results['Runtime (per cacheline update) [cy/CL]']),
            file=output_file)
        print('MEM volume (per repetition): {:.0f} Byte'.format(
            self.results['MEM volume (per repetition) [B]']),
            file=output_file)
        print('Performance: {:.2f} MFLOP/s'.format(self.results['Performance [MFLOP/s]']),
              file=output_file)
        print('Performance: {:.2f} MLUP/s'.format(self.results['Performance [MLUP/s]']),
              file=output_file)
        print('Performance: {:.2f} It/s'.format(self.results['Performance [MIt/s]']),
              file=output_file)
        if self.verbose > 0:
            print('MEM bandwidth: {:.2f} MByte/s'.format(self.results['MEM BW [MByte/s]']),
                  file=output_file)
        print('', file=output_file)

        if not self.no_phenoecm:
            print("Data Transfers:")
            print("{:^8} |".format("cache"), end='')
            for metrics in self.results['data transfers'].values():
                for metric_name in sorted(metrics):
                    print(" {:^14}".format(metric_name), end='')
                print()
                break
            for cache, metrics in sorted(self.results['data transfers'].items()):
                print("{!s:^8} |".format(cache), end='')
                for k, v in sorted(metrics.items()):
                    print(" {!s:^14}".format(v), end='')
                print()
            print()

            print('Phenomenological ECM model: {{ {T_OL:.1f} || {T_nOL:.1f} | {T_L1L2:.1f} | '
                  '{T_L2L3:.1f} | {T_L3MEM:.1f} }} cy/CL'.format(
                **{k: float(v) for k, v in self.results['ECM'].items()}),
                file=output_file)
            print('T_OL assumes that two loads per cycle may be retiered, which is true for '
                  '128bit SSE/half-AVX loads on SNB and IVY, and 256bit full-AVX loads on HSW, '
                  'BDW, SKL and SKX, but it also depends on AGU availability.',
                  file=output_file)