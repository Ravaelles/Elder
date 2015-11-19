<script type="text/javascript">
    window.initQueue.push(function () {
        mapWidth = canvas().width();
        mapHeight = canvas().height() - 60;
//            console.log(mapWidth + " / " + mapHeight);

        for (i = 0; i < 10; i++) {
            var critter = this["warrior_" + randomDir()];
            addUnit(critter);
        }
    });
</script>


<script type="text/javascript">
    var _firstFreeId = 1;

    function addUnit(critter) {
        var ID = _firstFreeId++;
        var element = critter;
        element = addAttr(element, "id", "unit-" + ID);
        element = addAttr(element, "class", "engine-unit");
        element = addAttrForce(element, "loop=infinite");
        canvas().append(element);
        
        var x = rand(0, mapWidth);
        var y = rand(0, mapHeight);

        var unit = unitPosition(ID, x, y);
        unit.css("z-index", y);
        
//        setTimeout(function() {
//            console.log(" === " + ID);
//            repaintUnitGif(ID);
//        }, 1000);
        setTimeout(repaintUnitGif, 2000, ID);

        return ID;
//        .css("margin-left", "300px")
    }
    
    function repaintUnitGif(ID) {
        var src = getUnit(ID).attr("src");
//        console.log("OK! " + ID);
        getUnit(ID).attr("src", "/img/empty.jpg");
        setTimeout(function() {
            repaintUnitGif(ID);
        }, 8000 + rand(0, 4000));
        getUnit(ID).attr("src", src);
    }

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
    @foreach (App\Critter::DIR_ALL as $dir)
    var warrior_{{ $dir }} = "{!! App\Helpers\CritterImage::create()->warrior()->dir($dir) !!}";
    @endforeach
</script>