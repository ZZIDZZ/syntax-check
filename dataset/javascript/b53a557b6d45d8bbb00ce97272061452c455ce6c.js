function bubble(values) {

  return values.map(d => {

    if (d.key && d.values) {
      if (d.values[0].key === "undefined") return d.values[0].values[0];
      else d.values = bubble(d.values);
    }

    return d;

  });

}