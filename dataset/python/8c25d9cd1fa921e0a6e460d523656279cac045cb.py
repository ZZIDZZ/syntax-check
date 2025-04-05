def publish(self):
      '''
      Write output file.
      '''
      with open( self.file_name, 'w') as fh:
         for k,v in self.args.iteritems():
            buf = StringIO.StringIO()
            buf.write(k)
            self._append_vals(buf,v)
            fh.write(buf.getvalue() + '\n')
            buf.close()