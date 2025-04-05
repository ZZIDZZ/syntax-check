function runSchedules () {
  // Sort by descending time order.
  schedules.sort(function (a, b) {
    return b.time - a.time
  })
  // Track the soonest interval run time, in case we're already there.
  var minNewTime = Number.MAX_VALUE
  // Iterate, from the end until we reach the current mock time.
  var i = schedules.length - 1
  var schedule = schedules[i]
  while (schedule && (schedule.time <= mock.time._CURRENT_TIME)) {
    schedule.fn()
    // setTimeout schedules can be deleted.
    if (!schedule.interval) {
      schedules.splice(i, 1)

    // setInterval schedules should schedule the next run.
    } else {
      schedule.time += schedule.interval
      minNewTime = Math.min(minNewTime, schedule.time)
    }
    schedule = schedules[--i]
  }
  // If an interval schedule is in the past, catch it up.
  if (minNewTime <= mock.time._CURRENT_TIME) {
    process.nextTick(runSchedules)
  }
}