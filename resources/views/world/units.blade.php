<script type="text/javascript">
    window.initQueue.push(function () {
    mapWidth = canvas().width() - 40;
            mapHeight = canvas().height() - 70;
            addGrass();
            addTrees();
            addWarriors();
    });</script>

<script type="text/javascript">
            function addGrass() {
            for (i = 0; i < 15; i++) {
            addGrass();
            }
            }

    function addTrees() {
    for (i = 0; i < 30; i++) {
    addTree();
    }
    }

    function addWarriors() {
    for (i = 0; i < 10; i++) {
    var warriorSprite = this["warrior_" + randomDir()];
            addUnit(warriorSprite, true);
    }
    }

    // =========================================================================

    var _firstFreeId = 1;
            function addUnit(critter, repaint) {
            var ID = _firstFreeId++;
                    // Create gif based on img string
                    var element = critter;
                    element = addAttr(element, "id", "unit-" + ID);
                    element = addAttr(element, "class", "engine-unit");
                    element = addAttrForce(element, "loop=infinite");
                    canvas().append(element);
                    // Set unit position
                    var x = rand(0, mapWidth);
                    var y = rand(0, mapHeight);
                    var unit = unitPosition(ID, x, y);
                    unit.css("z-index", y);
                    // Repeat gif animation from time to time
                    if (repaint) {
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
        console.log(tree);
        addUnit(tree);
    }

    function addGrass() {
            var grass = randElem([
            {!! App\Helpers\Nature::grassImages() !!}
            ]);
                    addUnit(grass);
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
    @foreach (App\Critter::DIR_ALL as $dir)
            var warrior_{{ $dir }} = "{!! App\Helpers\CritterImage::create()->warrior()->dir($dir) !!}";
            @endforeach
</script>