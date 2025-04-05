function deductcost() {
  var cost = [];
  if (!giving.have || giving.have.length < 1) return;

  // flatten
  var cost = [];
  for (var i = 0; i < giving.have.length; i++) {
    for (var j = 0; j < giving.have[i].length; j++) {
      cost.push(giving.have[i][j]);
    }
  }
  if (typeof cost[0] === 'string') cost = [cost];

  function deduct(from, amt) {
    var current = parseInt(from.getAttribute('data-quantity'));
    current -= amt;
    from.setAttribute('data-quantity', current);
    updateAmounts(from);
    if (current < 1) {
      from.setAttribute('data-type', 'none');
      from.innerHTML = '';
    }
  }

  [].forEach.call(craftable.querySelectorAll('li'), function(li, i) {
    var row = Math.floor(i / 3);
    var has = (li.getAttribute('data-type') || 'none').toLowerCase();
    for (var c = 0; c < cost.length; c++) {
      if (cost[c][0].toLowerCase() === has) {
        var price = cost[c][1];
        cost.splice(c, 1);
        deduct(li, price);
        return false;
      }
    }
  });
}