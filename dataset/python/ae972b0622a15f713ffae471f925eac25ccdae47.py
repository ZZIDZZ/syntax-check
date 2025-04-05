def makePlot(args):
  """
  Make the plot with radial velocity performance predictions.

  :argument args: command line arguments
  """
  gRvs=np.linspace(5.7,16.1,101)

  spts=['B0V', 'B5V', 'A0V', 'A5V', 'F0V', 'G0V',
        'G5V', 'K0V', 'K1IIIMP', 'K4V', 'K1III']

  fig=plt.figure(figsize=(10,6.5))
  deltaHue = 240.0/(len(spts)-1)
  hsv=np.zeros((1,1,3))
  hsv[0,0,1]=1.0
  hsv[0,0,2]=0.9
  count=0
  for spt in spts:
    hsv[0,0,0]=(240-count*deltaHue)/360.0
    vmag = vminGrvsFromVmini(vminiFromSpt(spt)) + gRvs
    vradErrors = vradErrorSkyAvg(vmag, spt)
    plt.plot(vmag, vradErrors, '-', label=spt, color=hsv_to_rgb(hsv)[0,0,:])
    count+=1
  plt.grid(which='both')
  plt.xlim(9,17.5)
  plt.ylim(0,20)
  plt.xticks(np.arange(9,18,1))
  plt.yticks(np.arange(0,20.5,5))
  plt.xlabel('$V$ [mag]')
  plt.ylabel('End-of-mission radial velocity error [km s$^{-1}$]')
  leg=plt.legend(loc=0,  handlelength=2.0, labelspacing=0.10)
  for t in leg.get_texts():
    t.set_fontsize(12)

  if (args['pdfOutput']):
    plt.savefig('RadialVelocityErrors.pdf')
  elif (args['pngOutput']):
    plt.savefig('RadialVelocityErrors.png')
  else:
    plt.show()