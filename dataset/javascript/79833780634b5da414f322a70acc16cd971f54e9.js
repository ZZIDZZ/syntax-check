function noProp(props, propNameOrFunction) {
    if (!props) {
        throw new Error('Headful: You must pass all declared props when you use headful.props.x() calls.');
    }
    const propName = typeof propNameOrFunction === 'function' ? propNameOrFunction.name : propNameOrFunction;
    return !props.hasOwnProperty(propName);
}