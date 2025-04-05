function random(number = 1) {
  if (1 > number) {
    throw Error(`Can't use numbers bellow 1, ${number} passed`);
  }

  if (number === 1) {
    return getRandomArrValue(dinosaurs);
  } else {
    const l = dinosaurs.length - 1;
    return new Array(number).fill().map(() => getRandomArrValue(dinosaurs, 0, l));
  }
}