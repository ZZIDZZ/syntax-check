function readBackupGPT(primaryGPT) {

  var backupGPT = new GPT({ blockSize: primaryGPT.blockSize })
  var buffer = Buffer.alloc( 33 * primaryGPT.blockSize )
  var offset = ( ( primaryGPT.backupLBA - 32 ) * blockSize )

  fs.readSync( fd, buffer, 0, buffer.length, offset )
  backupGPT.parseBackup( buffer )

  return backupGPT

}