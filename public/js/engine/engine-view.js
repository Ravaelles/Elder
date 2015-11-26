function EngineView(width, height) {

    this.width = -1;
    this.height = -1;

    // =========================================================================

    this.constructor = function (width, height) {
        this.width = width;
        this.height = height;
    };
    this.constructor(width, height);

    // =========================================================================

    this.getType = function () {
        return this.type;
    };

}