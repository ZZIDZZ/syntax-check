function _logDetails (action) {
    if (action) {
        console.log(`${chalk.white.bgRed('  Prev State:')} 
        ${__toString(state)}`);
        console.log(`${chalk.white.bgBlue('      Action:')} 
        ${__toString(action)}`);
    } else {
        console.log(`${chalk.white.bgGreen('  Next State:')}
        ${__toString(state)}`);
        console.log('\n');
    }
}