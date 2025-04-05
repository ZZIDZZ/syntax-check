function onCycle(event) {
  if(objectPool.length == 0) {
    throw new Error('Pool ran out of objects');
  }
  console.log(String(event.target));
  initPool();  
}