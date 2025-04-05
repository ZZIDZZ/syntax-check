function findAndDeleteAll(target, value) {
    let flag = false;
    while (findAndDelete(target, value)) {
        flag = true;
    }
    return flag;
}