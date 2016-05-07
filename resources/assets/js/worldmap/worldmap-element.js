function HtmlElement(left, top) {

    this._id = null; // Unique identifier
    this._selector = null; // jQuery selector of this html element
    this._top = null; // CSS "top" value in pixels
    this._left = null; // CSS "left" value in pixels
    this._htmlDOM = null; // DOM element that was used to create this html element
    this._styleString = null; // All styles for this element except "top" and "left"
    this._htmlString = null; // Ready html string

    // =========================================================================
    // Constructor

    this.constructor = function (left, top) {
        this._id = __firstFreeWorldmapElementId++;
        this._htmlDOM = document.createElement("div");
        this._left = left;
        this._top = top;

//        for (var fieldName in options) {
//            var value = options[fieldName];
//            fieldName = "_" + fieldName;
//            this.fieldName = value;
//        }
    };
    this.constructor(left, top);

    // =========================================================================

    this.getId = function () {
        return this._id;
    };

    this.getSelector = function () {
        if (this._selector === null) {
            this._selector = $("#html-element-" + this._id)
        }
        return this._selector;
    };

    // === Style ======================================================================

    this.setStyle = function (styleString) {
        this._styleString = styleString;
        this._htmlDOM.setAttribute('id', 'html-element-' + this._id);
        this._htmlDOM.setAttribute('style', styleString);
    };

    // === HTML elements ======================================================================

    this.getHtml = function () {
        if (this._htmlString === null) {
            this.prepareHtml();
        }
        return this._htmlString;
    };

    this.prepareHtml = function () {
        this.updateHtmlDOMPosition();
        this._htmlString = this._htmlDOM.outerHTML;
    };

    this.updateHtmlDOMPosition = function () {
        var style = this._styleString;
        style += "top:" + this._top + "px;";
        style += "left:" + this._left + "px;";
        this._htmlDOM.setAttribute('style', style);
    };

    // === Position ======================================================================

    this.translate = function (dx, dy) {
        this._left += dx;
        this._top += dy;

        this.getSelector().css({
            'left': this._left + 'px',
            'top': this._top + 'px'
        });
    };

//    this.setTop = function (top) {
//        this._top = top;
//    };

//    this.getTop = function () {
//        return this._top;
//    };

//    this.setLeft = function (left) {
//        this._left = left;
//    };

//    this.getLeft = function () {
//        return this._left;
//    };

}

// =========================================================================

__firstFreeWorldmapElementId = 1;

