<style>

</style>

<div class="box box-shadow engine-canvas" id="canvas">
    <div class="" style="position: absolute; margin-top: 200px; margin-left: 400px; width: 82px; border-bottom: 1px solid red;"></div>
    <div class="" style="position: absolute; margin-top: 200px; margin-left: 482px; width: 82px; border-bottom: 1px solid blue;"></div>

    <script type="text/javascript">
        window.initQueue.push(function () {
            mapWidth = canvas().width() - 40;
            mapHeight = canvas().height() - 70;
                //            addMiscs();
                //            addGrasses();
                //            addTrees();
                //            addWarriors();

                //        var unit = new CreateUnit(UNIT_TREE);

            generateTrees();
            generatePeople();
        });</script>

    <script type="text/javascript">
                function generatePeople() {
//                    for (var i = 0; i < 4; i++) {
var i = 1;
                        var unit = new Unit({'type': WARRIOR_MALE, 'dir': DIR_E})
//                                .positionRandomly()
                                .position(400, 100 + 100 * i)
                                .display();

//                        unit.walk({dir: DIR_SW}, 700);
//                        unit.walk({dir: DIR_NE});
                        unit.walk({dir: DIR_E}, 700);
                        unit.walk({dir: DIR_SE});
                        unit.walk({dir: DIR_SW});
                        unit.animation({dir: DIR_E, action: ACTION_IDLE});
                        unit.animation({action: SPEAR_EQUIP}, 600);
                        unit.animation({dir: DIR_SE, action: ACTION_IDLE});
                        unit.animation({action: SPEAR_EQUIP}, 500);
                        unit.animation({dir: DIR_SW, action: ACTION_IDLE});
                        unit.animation({dir: DIR_SW, action: SPEAR_EQUIP});
                        unit.animation({dir: DIR_W, action: ACTION_IDLE});
                        unit.animation({dir: DIR_W, action: SPEAR_EQUIP}, 600);
                        unit.animation({dir: DIR_NW, action: ACTION_IDLE});
                        unit.animation({dir: DIR_NW, action: SPEAR_EQUIP}, 600);
                        unit.animation({dir: DIR_NE, action: ACTION_IDLE});
                        unit.animation({dir: DIR_NE, action: SPEAR_EQUIP}, 600);
                        for (var i = 1; i < 0; i++) {
                            unit.animation({dir: DIR_E});
                            unit.animation({dir: DIR_W});
//                            unit.animation({dir: DIR_E});
//                            unit.animation({dir: DIR_SE});
//                            unit.animation({dir: DIR_SW});
//                            unit.animation({dir: DIR_W});
//                            unit.animation({dir: DIR_NW});
//                            unit.animation({dir: DIR_NE});
                        }
            }

        function generateTrees() {
            for (var i = 0; i < 30; i++) {
                var unit = new Unit({'type': NATURE_TREE})
                        .positionRandomly()
                                    .display();
            }
        }
    </script>

    <script type="text/javascript">
        //            function addMiscs() {
        //            for (var i = 0; i < 10; i++) {
        //            addMisc();
        //            }
        //            }
        //
        //    function addGrasses() {
        //    for (var i = 0; i < 20; i++) {
        //    addGrass();
        //    }
        //    }
        //
        //    function addTrees() {
        //    for (var i = 0; i < 30; i++) {
        //    addTree();
        //    }
        //    }
        //
        //    function addWarriors() {
        //    for (var i = 0; i < 10; i++) {
        ////    var warriorSprite = this["warrior_" + randomDir()];
        ////            addUnit(warriorSprite, true);
        //    }
        //    }

        // =========================================================================

        //    function addUnit(unit, isAlive) {
        //        var ID = _firstFreeId++;
        //        // Create gif based on img string
        //                            var element = unit;
        //                            element = addAttr(element, "id", "unit-" + ID);
        //                                                var elemClass = "engine-unit";
        //                                                if (isAlive) {
        //                                        elemClass += " unit-alive";
        //                                        }
        //                            element = addAttr(element, "class", elemClass);
        ////                    element = addAttrForce(element, "loop=infinite");
        //                            canvas().append(element);
        //                            // Set unit position
        //                            var x = rand(0, mapWidth);
        //                            var y = rand(0, mapHeight);
        //                            var unit = unitPosition(ID, x, y);
        //                            unit.css("z-index", y);
        //                            // Repeat gif animation from time to time
        //                            if (isAlive) {
        //                    setTimeout(repaintUnitGif, 4000, ID);
        //                    }
        //
        //        return ID;
        //    }

        //    function repaintUnitGif(ID) {
        //
        //    // Change gif image for a very short moment so browser knows it's really changed
        //    var src = getUnit(ID).attr("src");
        //            getUnit(ID).attr("src", "/img/empty.jpg");
        //            // Schedule recurential execution.
        //            setTimeout(function() {
        //            repaintUnitGif(ID);
        //            }, 7000 + rand(0, 7000));
        //            // Get back to normal gif
        //            getUnit(ID).attr("src", src);
        //    }

        // =========================================================================

        //    function addAttr(stringHtml, attr, value) {
        //    return stringHtml.substring(0, stringHtml.length - 2) + attr + "='" + value + "' "
        //            + stringHtml.substring(stringHtml.length - 2);
        //    }
        //
        //    function addAttrForce(stringHtml, value) {
        //    return stringHtml.substring(0, stringHtml.length - 2) + value
        //            + stringHtml.substring(stringHtml.length - 3);
        //    }

        //    function randomDir() {
        //    return randArray(['w', 'e', 'nw', 'ne', 'se', 'sw']);
        //    }

        //    function unitPosition(ID, x, y) {
        //    var unit = getUnit(ID);
        //            unit.css("margin-left", x + "px");
        //            unit.css("margin-top", y + "px");
        //            return unit;
        //    }
        //
        //    function getUnit(ID) {
        //    return $("#unit-" + ID);
        //    }

        function canvas() {
        return $("#canvas");
        }
    </script>

    <script type="text/javascript">
        function CreateUnit(type) {

        this.creator = function (type) {

        // TREE
        if (type === UNIT_TREE) {
        return randElem([
        {!! App\Helpers\Nature::treeImages() !!}
        ]);
        }
        // GRAS
        else if (type === UNIT_GRAS) {
        return randElem([
        {!! App\Helpers\Nature::grassImages() !!}
        ]);
        }

        return "UNKNOWN_UNIT_TYPE";
        };
                this.creator(type);
        }

        UNIT_TREE = "tree";
                UNIT_GRASS = "grass";
                UNIT_MISC = "misc";
                UNIT_WARRIOR = "warrior";
                //    UNIT_ = "";
    </script>
</div><!--/.canvas-->