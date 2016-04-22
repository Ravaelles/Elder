function isDefined(param) {
    return typeof param != 'undefined';
}

function isUndefined(param) {
    return typeof param == 'undefined';
}

function cloneObject(object) {
    return JSON.parse(JSON.stringify(object));
}