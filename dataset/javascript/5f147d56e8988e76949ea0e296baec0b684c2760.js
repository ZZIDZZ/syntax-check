function rayLineVsCircle(ray, circle) {
  var rayLine = new Line2(
    ray.start.x,
    ray.start.y,
    ray.end.x,
    ray.end.y
  );

  return rayLine.intersectCircle(circle.position, circle.radius);
}