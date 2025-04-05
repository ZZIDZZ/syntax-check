function initCompDirs(){
  var compRoot = path.resolve(process.cwd(),'src/components'),
      compReg  = /^[A-Z]\w+$/;

  //['Button', 'Select']
  compDirs = fs.readdirSync(compRoot).filter(function(filename){
    return compReg.test(filename)
  })

  return compDirs
}