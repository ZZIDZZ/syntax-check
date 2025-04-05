function bind_d3(f, context) {
    return function() {
        var args = [this].concat([].slice.call(arguments)) // convert argument to array
        f.apply(context, args)
    }
}