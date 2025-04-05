function allSettled(promises) {
    "use strict";
    const wrappedPromises = promises.map((curPromise) => curPromise.reflect());
    return Promise.all(wrappedPromises);
}