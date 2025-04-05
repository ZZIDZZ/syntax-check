function dateDifferenceFromNow(date, differenceType) {
    var now = new Date(),
        diffMilliseconds = Math.abs(date - now);

    switch(differenceType) {
        case 'days':
            return dates._getDaysDiff(diffMilliseconds);
        case 'hours':
            return dates._differenceInHours(diffMilliseconds);
        case 'minutes':
            return dates._differenceInMinutes(diffMilliseconds);
        case 'milliseconds':
            return diffMilliseconds;

        default:
            return {
                days: dates._getDaysDiff(diffMilliseconds),
                hours: dates._getHoursDiff(diffMilliseconds),
                minutes: dates._getMinutesDiff(diffMilliseconds),
                milliseconds: diffMilliseconds
            }
    }
}