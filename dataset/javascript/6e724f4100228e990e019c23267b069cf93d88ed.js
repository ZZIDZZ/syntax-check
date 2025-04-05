function getFirstIndexOfArray(arrayToSearchFor, arrayToSearchInside) {
    errorIfNotArray_1.errorIfNotArray(arrayToSearchFor);
    error_if_not_populated_array_1.errorIfNotPopulatedArray(arrayToSearchInside);
    return arrayToSearchInside.findIndex(function (value) {
        return (isArray_notArray_1.isArray(value) && arrays_match_1.arraysMatch(value, arrayToSearchFor));
    });
}