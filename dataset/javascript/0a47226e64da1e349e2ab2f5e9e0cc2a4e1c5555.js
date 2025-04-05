function onRejected(error) {

            attemts_left -= 1;

            if (attemts_left < 1) {
                throw error;
            }

            console.log("A retried call failed. Retrying " + attemts_left + " more time(s).");

            // retry call self again with the same arguments, except attemts_left is now lower
            var fullArguments = [attemts_left, promiseFunction].concat(promiseFunctionArguments);
            return module.exports.retryPromise.apply(undefined, fullArguments);
        }