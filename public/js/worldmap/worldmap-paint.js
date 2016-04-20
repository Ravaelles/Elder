function createLineElement(x, y, length, angle) {
    var line = document.createElement("div");
    var styles = 'border: 1px dashed red; '
            + 'width: ' + length + 'px; '
            + 'height: 0px; '
            + '-moz-transform: rotate(' + angle + 'rad); '
            + '-webkit-transform: rotate(' + angle + 'rad); '
            + '-o-transform: rotate(' + angle + 'rad); '
            + '-ms-transform: rotate(' + angle + 'rad); '
            + 'position: absolute; '
            + 'top: ' + y + 'px; '
            + 'left: ' + x + 'px; ';
    line.setAttribute('style', styles);
    return line;
}

function createLine(x1, y1, x2, y2) {
    var a = x1 - x2,
            b = y1 - y2,
            c = Math.sqrt(a * a + b * b);

    var sx = (x1 + x2) / 2,
            sy = (y1 + y2) / 2;

    var x = sx - c / 2,
            y = sy;

    var alpha = Math.PI - Math.atan2(-b, a);

    return createLineElement(x, y, c, alpha);
}

window.initQueue.push(function () {
    setTimeout(function () {
        getWorldmap().append(createLine(300, 300, 500, 500));
        getWorldmap().append(createLine(300, 300, 300, 500));
        getWorldmap().append(createLine(300, 300, 400, 300));
    }, 100);
});