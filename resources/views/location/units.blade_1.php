<script type="text/javascript">
    window.initQueue.push(function () {
    mapWidth = canvas().width() - 40;
            mapHeight = canvas().height() - 70;
            addMiscs();
                        addGrasses();
            addTrees();
            addWarriors();
    });</script>

<script type="text/javascript">
            function addMiscs() {
            for (var i = 0; i < 10; i++) {
                        addMisc();
                        }
                        }

                function addGrasses() {
            for (var i = 0; i < 20; i++) {
                addGrass();
            }
            }

    function addTrees() {
        for (var i = 0; i < 30; i++) {
                            addTree();
                    }
    }

    function addWarriors() {
    for (var i = 0; i < 10; i++) {
    var warriorSprite = this["warrior_" + randomDir()];
            addUnit(warriorSprite, true);
    }
    }

    // =========================================================================

    var _firstFreeId = 1;
    function addUnit(unit, isAlive) {
        var ID = _firstFreeId++;
        // Create gif based on img string
                            var element = unit;
                            element = addAttr(element, "id", "unit-" + ID);
                                                var elemClass = "engine-unit";
                                                if (isAlive) {
                                        elemClass += " unit-alive";
                                        }
                            element = addAttr(element, "class", elemClass);
//                    element = addAttrForce(element, "loop=infinite");
                            canvas().append(element);
                            // Set unit position
                            var x = rand(0, mapWidth);
                            var y = rand(0, mapHeight);
                            var unit = unitPosition(ID, x, y);
                            unit.css("z-index", y);
                            // Repeat gif animation from time to time
                            if (isAlive) {
                    setTimeout(repaintUnitGif, 4000, ID);
                    }

        return ID;
    }

    function repaintUnitGif(ID) {

    // Change gif image for a very short moment so browser knows it's really changed
    var src = getUnit(ID).attr("src");
            getUnit(ID).attr("src", "/img/empty.jpg");
            // Schedule recurential execution.
            setTimeout(function() {
            repaintUnitGif(ID);
            }, 7000 + rand(0, 7000));
            // Get back to normal gif
            getUnit(ID).attr("src", src);
    }

    function addTree() {
        var tree = randElem([
            {!! App\Helpers\Nature::treeImages() !!}
        ]);
        addUnit(tree);
    }

    function addGrass() {
            var grass = randElem([
            {!! App\Helpers\Nature::grassImages() !!}
            ]);
                    addUnit(grass);
    }

    function addMisc() {
            var misc = randElem([
    {!! App\Helpers\Nature::miscImages() !!}
    ]);
            addUnit(misc);
    }

    // =========================================================================

    function addAttr(stringHtml, attr, value) {
    return stringHtml.substring(0, stringHtml.length - 2) + attr + "='" + value + "' "
            + stringHtml.substring(stringHtml.length - 2);
    }

    function addAttrForce(stringHtml, value) {
    return stringHtml.substring(0, stringHtml.length - 2) + value
            + stringHtml.substring(stringHtml.length - 3);
    }

    function randomDir() {
    return randArray(['w', 'e', 'nw', 'ne', 'se', 'sw']);
    }

    function unitPosition(ID, x, y) {
    var unit = getUnit(ID);
            unit.css("margin-left", x + "px");
            unit.css("margin-top", y + "px");
            return unit;
    }

    function getUnit(ID) {
    return $("#unit-" + ID);
    }

    function canvas() {
    return $("#canvas");
    }
</script>

<script type="text/javascript">

    // WARRIOR
    @foreach (App\Unit::DIR_ALL as $dir)
            var warrior_{{ $dir }} = "{!! App\Helpers\UnitImage::create('')->warrior()->dir($dir) !!}";
            @endforeach
</script>