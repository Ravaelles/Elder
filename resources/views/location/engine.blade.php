<style>

</style>

<div class="box box-shadow engine-canvas" id="canvas">
    <div id="canvas-debug">

    </div>

    <!--    <div class="" style="position: absolute; margin-top: 200px; margin-left: 400px; width: 82px; border-bottom: 1px solid red;"></div>
        <div class="" style="position: absolute; margin-top: 200px; margin-left: 482px; width: 82px; border-bottom: 1px solid blue;"></div>-->

    <script type="text/javascript">
        window.initQueue.push(function () {
            initMap();
            generateMisc();
            generateTrees();
            generatePeople();
        });</script>

    <script type="text/javascript">
                function generatePeople() {
//                    for (var i = 0; i < 4; i++) {
var i = 1;
//                        var unit = new Unit({type: WARRIOR_MALE, action: SPEAR_IDLE, dir: DIR_E})
                        var unit = new Unit({type: WARRIOR_MALE, dir: DIR_E})
//                                .positionRandomly()
                                .position(400, 100 + 100 * i)
                                .display();

//                        unit.animation({dir: DIR_E});
//                        unit.animation({action: SPEAR_UNEQUIP});
//                        unit.animation({dir: DIR_E});
//                        unit.animation({dir: DIR_SE});
//                        unit.equipWeapon("SPEAR");
//                        unit.walk();
//                        unit.walk({dir: DIR_E}, 700);
//                        unit.walk({dir: DIR_E});
                
//                for (var i = 0; i < 20; i++) {
//                        unit.walk({dir: DIR_SE});
//                        unit.walk({dir: DIR_SE});
//                        unit.walk({dir: DIR_SE});
//                        unit.walk({dir: DIR_SE});
//                        unit.walk({dir: DIR_SE});
//                        unit.walk({dir: DIR_NW});
//                        unit.walk({dir: DIR_NW});
//                        unit.walk({dir: DIR_NW});
//                    }
                        unit.walk({dir: DIR_E});
                        unit.walk({dir: DIR_E});
                        unit.walk({dir: DIR_E});
                        unit.walk({dir: DIR_SE});
                        unit.walk({dir: DIR_SE});
                        unit.walk({dir: DIR_SE});
                        unit.walk({dir: DIR_SW});
                        unit.walk({dir: DIR_SW});
                        unit.walk({dir: DIR_SW});
//                }
            }

        function generateTrees() {
            for (var i = 0; i < 230; i++) {
                var unit = new Unit({'type': NATURE_TREE})
                        .positionRandomly()
                                    .display();
            }
        }

        function generateMisc() {
            for (var i = 0; i < 100; i++) {
                var unit = new Unit({'type': NATURE_GRASS})
                        .positionRandomly()
                                    .display();
            }
        }

        function initMap() {
            canvas = $("#canvas");
            mapWidth = canvas.width() - 40;
            mapHeight = canvas.height() - 70;
        }
    </script>
</div><!--/.canvas-->