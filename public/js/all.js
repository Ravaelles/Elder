function EngineView(i,t){this.width=-1,this.height=-1,this.constructor=function(i,t){this.width=i,this.height=t},this.constructor(i,t),this.getType=function(){return this.type}}function buildStyleStringForImg(i,t,n,e,o,a){var r="position: relative; ";if(n)i.marginLeft=e.width()/2-o/2,i.marginTop=e.height()/2-a/2,(t._action===SPEAR_EQUIP||t._action===SPEAR_UNEQUIP)&&(i.marginTop-=18,i.marginLeft-=17);else{if(i.marginLeft=-o/2,i.marginTop=-a,t.isActionWalk()){if(t.isActionWithWeapon(WEAPON_SPEAR))var s=.25,m=.3;else var s=.38,m=.32;var d=a/5;t._dir===DIR_E?i.marginLeft+=o*s:t._dir===DIR_W?i.marginLeft+=-o*s:t._dir===DIR_SE?(i.marginLeft+=o*m,i.marginTop+=a*m):t._dir===DIR_SW?(i.marginLeft-=o*m,i.marginTop+=a*m):t._dir===DIR_NW?(i.marginLeft+=-o*m,i.marginTop+=-a*m+d):t._dir===DIR_NE&&(i.marginLeft+=o*m,i.marginTop+=-a*m+d)}(t._action===SPEAR_EQUIP||t._action===SPEAR_UNEQUIP)&&(t._dir===DIR_SE?(i.marginLeft-=14,i.marginTop+=8):t._dir===DIR_SW?i.marginLeft-=18.5:t._dir===DIR_NE?(i.marginLeft+=18,i.marginTop+=3.5):t._dir===DIR_NW?i.marginLeft+=15:t._dir===DIR_E?(i.marginLeft-=5,i.marginTop+=12):t._dir===DIR_W&&(i.marginLeft+=4))}return i.marginLeft+=t.positionPX,i.marginTop+=t.positionPY,i.marginLeft&&(r+="left:"+i.marginLeft+"px; "),i.marginTop&&(r+="top:"+i.marginTop+"px; ",r+="z-index: "+(i.marginTop+a)+"; "),r}function DIR_RANDOM(){return randElem(DIR_ALL)}function DIR_RANDOM_SOUTH(){return randElem([DIR_SW,DIR_SE])}function DIR_RANDOM_NORTH(){return randElem([DIR_NW,DIR_NE])}function Unit(i){this._id=null,this._sex=null,this._action=null,this._dir=null,this._type=null,this.staticImageDisplayMode=!1,this.marginLeft=0,this.marginTop=0,this.positionPX=0,this.positionPY=0,this._lastAnimationEndsAt=0,this._divSelector=null,this.constructor=function(i){var t;t="string"==typeof i?JSON.parse(i):i,this._id=t.id?t.id:__firstFreeUnitId++,this._sex=t.sex?"n"+t.sex.toLowerCase():MALE,this._action=t.action?t.action:ACTION_IDLE,this._dir=t.dir?t.dir:DIR_SE,this._type=t.type,this._type||(console.log("Empty unit type for unit:"),console.log(this),alert("Empty unit type passed for new unit")),allUnits[this._id]=this},this.constructor(i),this.display=function(i){function t(i,t){$("#unit-img-"+i).attr("src",t)}this.staticImageDisplayMode=i;var n=this.createImageElement(),e=n.imageElement,o=n.imagePath;this.staticImageDisplayMode||this.createImageWrapper();var a=new Image;return a.unitId=this._id,a.unit=this,a.imageIsLoaded=!1,a.onload=function(n){var a="<script>$('#unit-img-"+this.unitId+"').css('border', '1px solid rgba(255,0,0,0.2)')</script>";NaN+this.unitId+"').css('border', 'none'); }, 1000)</script>",$("#canvas-debug").html(a);var r=$("#unit-img-"+this.unitId).attr("src");if(t(this.unitId,r),!this.imageIsLoaded){var s=this.unit;this.imageIsLoaded=!0,this.src=o;var m=this.width,d=this.height,_=$("#unit-wrapper-"+this.unitId);_.html(e);var c=$("#unit-img-"+this.unitId);s._imageSelector=c,c.attr({imgwidth:m,imgheight:d}),c.css("z-index",s.positionPY);var u=buildStyleStringForImg(this,s,i,_,m,d);u&&c.attr("style",u)}},a.src=o,this},this._queueAnimations=[],this.queueAnimation=function(i,t,n){var e,o=this.timeSinceLastAnimationEndedAgo(),a=o>=-20;if(n||(n=WALK_ANIMATION_LENGTH),t||(t=0),a?(e=0,this._lastAnimationEndsAt=this.timeNow()+t+n):(e=-o,this._lastAnimationEndsAt+=t+e+n),a&&0===this._queueAnimations.length)this._runAnimationNow(i,t,n);else{var r={options:i,animationLength:n,delay:t};this._queueAnimations.push(r)}return this},this._runAnimationNow=function(i,t,n){var e=this;return setTimeout(function(){var t=i.callbackAnimationAfterStart;t&&t(e,i),e._animate(i),setTimeout(function(){var t=i.callbackAnimationEnded;t&&t(e),e.runNextQueuedAnimationIfNeeded()},n,e)},t),this},this.runNextQueuedAnimationIfNeeded=function(){var i=this._queueAnimations.shift();if(void 0!==i){var t=i.options,n=i.animationLength,e=i.delay;this._runAnimationNow(t,e,n)}},this._animate=function(i,t){t||(t=0),i||(i=[]);var n=i.callbackAnimationBeforeStart;n&&n(this);var e=this;return setTimeout(function(){e.handleOptions(i),e.display(e.staticImageDisplayMode)},t),this._lastAnimationStarted+=t,this},this.timeSinceLastAnimationEndedAgo=function(){return this.timeNow()-this._lastAnimationEndsAt},this.timeNow=function(){return(new Date).getTime()},this.animation=function(i,t,n){return i||(i={}),n||(n=1700),(!t||0>t)&&(t=0),this.queueAnimation(i,t,n),this},this.walk=function(i,t){var n=WALK_ANIMATION_LENGTH+ +(0===this._queueAnimations.length?WALK_ANIMATION_MODIFIER_WHEN_FIRST:0);this.timeSinceLastAnimationEndedAgo();return t||(t=0),i||(i=[]),i.callbackAnimationAfterStart=function(i,t){i.convertActionToWalk()},i.callbackAnimationEnded=function(i){i.handleWalkPositionChange(),0===i._queueAnimations.length&&(i.convertActionToIdle(),i._animate())},this.queueAnimation(i,t,n),this},this.convertActionToWalk=function(){return this._action=this._action.replaceAt(1,"b"),this},this.convertActionToIdle=function(){return this._action=this._action.replaceAt(1,"a"),this},this.handleWalkPositionChange=function(){var i=82,t=36,n=0,e=0;return this._dir===DIR_E?n+=i:this._dir===DIR_W?n-=i:this._dir===DIR_SE?(n+=t,e+=t):this._dir===DIR_SW?(n-=t,e+=t):this._dir===DIR_NW?(n-=t,e-=t):this._dir===DIR_NE&&(n+=t,e-=t),this.positionPX+=n,this.positionPY+=e,this},this.equipWeapon=function(i,t){var n={action:window[i+"_EQUIP"]};if(n.callbackAnimationEnded=function(t){t._action=window[i+"_IDLE"]},i===WEAPON_SPEAR)var e=1300;else var e=1300;return this.queueAnimation(n,t,e),this},this.positionRandomly=function(){return this.positionPX=rand(0,engineView.width),this.positionPY=rand(0,engineView.height),this},this.position=function(i,t){return i||t?(this.positionPX=i,this.positionPY=t,this):{x:this.positionPX,y:this.positionPY}},this.createImageElement=function(){var i="unit-img-"+this._id,t=this._id?"id='"+i+"'":"",n="";if(this.isStaticImage())var e=this._type.substring(7),o="/img/nature/"+e+"/"+rand(1,numOfImages[e]),a=o+".png";else{var o=BASE_IMG_DIR+"all/"+this._sex+this._type+this._action+"_"+this._dir,a=o+".gif";n="unit-alive"}var r="<img "+t+" class='"+n+"' src='"+a+"' />";return{imageElement:r,imagePath:a}},this.createImageWrapper=function(){var i="unit-wrapper-"+this._id;null!==this._divSelector?this._divSelector.html("<div class='engine-unit' id='"+i+"'></div>"):($("#canvas").append("<div class='engine-unit' id='"+i+"'></div>"),this._divSelector=$("#canvas #"+i))},this.handleOptions=function(i){return i&&("undefined"!=typeof i.action&&(this._action=i.action),"undefined"!=typeof i.sex&&(this._sex=i.sex),"undefined"!=typeof i.dir&&(this._dir=i.dir),"undefined"!=typeof i.type&&(this._type=i.type)),this},this.dirTowardEast=function(){return-1!==[DIR_E,DIR_SE,DIR_NE].indexOf(this._dir)},this.dirTowardWest=function(){return-1!==[DIR_W,DIR_NW,DIR_SW].indexOf(this._dir)},this.dirTowardNorth=function(){return-1!==[DIR_NW,DIR_NE].indexOf(this._dir)},this.dirTowardSouth=function(){return-1!==[DIR_SW,DIR_SE].indexOf(this._dir)},this.isStaticImage=function(){return null!==this._type&&stringStartsWith(this._type,"nature_")},this.isActionWalk=function(){return"b"===this._action.charAt(1)},this.isActionWithWeapon=function(i){return i===WEAPON_SPEAR?weaponLetter="g":weaponLetter="a",this._action.charAt(0)===weaponLetter.charAt(0)},this.dir=function(i){return void 0===i?this._dir:void(this._dir=i)},this.action=function(i){return void 0===i?this._action:void(this._action=i)}}function gameLog(i){$(".game-log p").css("opacity","0.7"),$(".game-log").prepend("<p style='display: none' class='game-log-invisible'><span class='dot'>•</span> "+i+"</p>"),$(".game-log .game-log-invisible").slideDown(700)}function gameMessage(i,t,n){"undefined"==typeof t&&(t=!0),n&&(n="color: "+n);var e=$(".game-messages");t&&e.html(""),e.prepend("<div class='game-message' style='width: "+WORLDMAP_CANVAS_WIDTH+"px;"+n+"'>"+i+"</div>")}function isDefined(i){return"undefined"!=typeof i}function isUndefined(i){return"undefined"==typeof i}function getMapCoordinatesFromScreenClick(i){var t=i.pageX-WORLDMAP_CANVAS_MARGIN_LEFT,n=i.pageY-WORLDMAP_CANVAS_MARGIN_TOP,e=-1*worldmap.css("background-position-x").slice(0,-2),o=e*zoom,a=WORLDMAP_CANVAS_WIDTH*zoom,r=t/WORLDMAP_CANVAS_WIDTH,s=-1*worldmap.css("background-position-y").slice(0,-2),m=s*zoom,d=WORLDMAP_CANVAS_HEIGHT*zoom,_=n/WORLDMAP_CANVAS_HEIGHT,c=parseInt(o+r*a),u=parseInt(m+_*d);return{mapX:c,mapY:u}}function getCanvasCoordinatesFromMapCoordinates(i,t){return{canvasX:WORLDMAP_CANVAS_MARGIN_LEFT+i/zoom-getMapOffsetPixelsX()+2,canvasY:WORLDMAP_CANVAS_MARGIN_TOP+t/zoom-getMapOffsetPixelsY()+1}}function coordinatesToString(i){return"canvasX"in i?"["+i.canvasX+","+i.canvasY+"]":"["+i.mapX+","+i.mapY+"]"}function initializeWorldmapEvents(){$(".worldmap-location").mousedown(function(i){mapMouseDown(i),i.stopPropagation()}).mouseup(function(i){mapMouseUp(i),i.stopPropagation()}).mousemove(function(i){mapMouseMove(i),i.stopPropagation()}),$(".worldmap").mousedown(function(i){mapMouseDown(i)}).mouseup(function(i){mapMouseUp(i)}).mousemove(function(i){mapMouseMove(i)}).mousewheel(function(i){mapScroll(i)}).mouseleave(function(i){mapMouseLeave(i)}).contextmenu(function(i){})}function mapMouseDown(i){worldmap=$(".worldmap"),2===i.button,mousePreviousPosition=i,mouseIsClicked=!0,mouseHasMoved=!1}function mapMouseUp(i){mouseHasMoved||mapClick(i),mouseIsClicked=!1,mousePreviousPosition=null}function mapMouseMove(i){mouseIsClicked&&(mouseHasMoved=!0),mouseIsClicked&&null!=mousePreviousPosition&&(translationVector=moveWorldmapImage(i),moveWorldmapObjects(translationVector)),mousePreviousPosition=i,gameMessage("Mouse points to "+coordinatesToString(getMapCoordinatesFromScreenClick(i)))}function mapScroll(i){var t=i.deltaY;t>=1?changeZoom(i,!1):-1>=t&&changeZoom(i,!0),mapMouseMove(i)}function mapMouseLeave(i){mouseIsClicked&&(mapMouseUp(i),mouseIsClicked=!1)}function mapClick(i){var t=getMapCoordinatesFromScreenClick(i);gameLog("<span>["+t.mapX+","+t.mapY+"]</span> is unknown wasteland, not very hospitable place.")}function initializeWorldmapLocations(){var i=$(".worldmap");recalculateWorldmapLocationVariables(),worldmapLocations.forEach(function(t,n){i.append(createHtmlFromLocationJson(t,n))})}function createHtmlFromLocationJson(i,t){var n=i._id,e=i.location.x+","+i.location.y,o=WORLDMAP_LOCATION_SIZE,a=getCanvasCoordinatesFromMapCoordinates(i.location.x,i.location.y),r="top:"+(a.canvasY-o/2)+"px;left:"+(a.canvasX-o/2)+"px;width:"+o+"px;height:"+o+"px;";return'<div class="worldmap-location" id="worldmap-location-'+n+'" variableName="worldmapLocations" variableIndex="'+t+'" style="'+r+'"><label style="margin-top:'+WORLDMAP_LOCATION_LABEL_MARGIN_TOP+'px">'+e+"</label></div>"}function recalculateWorldmapLocationVariables(){WORLDMAP_LOCATION_SIZE=WORLDMAP_LOCATION_SIZE_MODIFIER/zoom,WORLDMAP_LOCATION_LABEL_MARGIN_TOP=WORLDMAP_LOCATION_SIZE_MODIFIER/zoom*.99}function moveWorldmapImage(i){var t=i.pageX-mousePreviousPosition.pageX,n=i.pageY-mousePreviousPosition.pageY,e=worldmap.css("background-position-x"),o=worldmap.css("background-position-y");if(e=parseFloat(e.substr(0,e.length-2)),o=parseFloat(o.substr(0,o.length-2)),deltaImagePosX=t,deltaImagePosY=n,e+=deltaImagePosX,o+=deltaImagePosY,imagePosXWithScreenWidth=e-WORLDMAP_CANVAS_WIDTH,imagePosYWithScreenHeight=o-WORLDMAP_CANVAS_HEIGHT,e>0){var a=e;e=0,deltaImagePosX-=a-e}else if(imagePosXWithScreenWidth<=-WORLDMAP_WIDTH/zoom){var a=e;e=-WORLDMAP_WIDTH/zoom+WORLDMAP_CANVAS_WIDTH,deltaImagePosX-=a-e}if(o>0){var r=o;o=0,deltaImagePosY-=r-o}else if(imagePosYWithScreenHeight<=-WORLDMAP_HEIGHT/zoom){var r=o;o=-WORLDMAP_HEIGHT/zoom+WORLDMAP_CANVAS_HEIGHT,deltaImagePosY-=r-o}return setBackgroundImagePosition(e,o),updateCurrentView(e,o),{dx:deltaImagePosX,dy:deltaImagePosY}}function moveWorldmapObjects(i){var t=$(".worldmap-location");$.each(t,function(t,n){var e=$("#"+n.id);e.css("top",parseFloat(e.css("top"))+i.dy),e.css("left",parseFloat(e.css("left"))+i.dx)})}function setBackgroundImagePosition(i,t){worldmap.css("background-position-x",i+"px"),worldmap.css("background-position-y",t+"px")}function addWorldmapObject(){}function WEngine_paintLine(i,t,n,e,o){canvasCoords=getCanvasCoordinatesFromMapCoordinates(i,t),i=canvasCoords.canvasX,t=canvasCoords.canvasY,canvasCoords=getCanvasCoordinatesFromMapCoordinates(n,e),n=canvasCoords.canvasX,e=canvasCoords.canvasY;var a=_WEngine_getLine(i,t,n,e,o);getWorldmap().append(a)}function WEngine_paintRectangleFromArray(i,t){return WEngine_paintRectangle(i.x,i.y,i.x+i.width,i.y+i.height,t)}function WEngine_paintRectangle(i,t,n,e,o){WEngine_paintLine(i,t,n,t,o),WEngine_paintLine(i,e,n,e,o),WEngine_paintLine(i,t,i,e,o),WEngine_paintLine(n,t,n,e,o)}function _WEngine_getLine(i,t,n,e,o){var a=i-n,r=t-e,s=Math.sqrt(a*a+r*r),m=(i+n)/2,d=(t+e)/2,_=m-s/2,c=d,u=Math.PI-Math.atan2(-r,a);return _WEngine_getLine_element(_,c,s,u,o)}function _WEngine_getLine_element(i,t,n,e,o){var a=document.createElement("div"),r="border: "+WENGINE_DEFAULT_LINE_WIDTH+"px dashed red; width: "+n+"px; height: 0px; -moz-transform: rotate("+e+"rad); -webkit-transform: rotate("+e+"rad); -o-transform: rotate("+e+"rad); -ms-transform: rotate("+e+"rad); position: absolute; top: "+t+"px; left: "+i+"px; ";if(isDefined(o))for(var s in o)r+=s+":"+o[s]+";";return a.setAttribute("style",r),a}function initializeWorldmapZoom(){initializeWorldmapView(),getWorldmap().css("background-size",currentWorldmapImageWidth+"px"),getWorldmap().css("background-position-x","-"+currentWorldmapView.x+"px"),getWorldmap().css("background-position-y","-"+currentWorldmapView.y+"px"),currentWorldmapImageWidth=WORLDMAP_IMAGE_INITIAL_WIDTH,currentWorldmapImageHeight=currentWorldmapImageWidth*WORLDMAP_CANVAS_WIDTH/WORLDMAP_CANVAS_HEIGHT,zoom=WORLDMAP_WIDTH/currentWorldmapImageWidth}function initializeWorldmapView(){currentWorldmapView={x:WORLDMAP_IMAGE_INITIAL_X,y:WORLDMAP_IMAGE_INITIAL_Y,width:WORLDMAP_CANVAS_WIDTH,height:WORLDMAP_CANVAS_HEIGHT}}function changeZoom(i,t){oldMapImageWidth=currentWorldmapImageWidth,oldZoom=zoom,t?currentWorldmapImageWidth-=zoomStep:currentWorldmapImageWidth+=zoomStep,zoom=WORLDMAP_WIDTH/currentWorldmapImageWidth;var n=MIN_ZOOM_VALUE>zoom,e=WORLDMAP_CANVAS_WIDTH>currentWorldmapImageWidth;if(n||e)return revertZoom();var o=currentWorldmapView.x+currentWorldmapView.width;currentWorldmapView.y+currentWorldmapView.height;console.log(o+" / "+WORLDMAP_WIDTH);var a=o>WORLDMAP_WIDTH;return a?revertZoom():($(".worldmap").css("background-size",currentWorldmapImageWidth+"px"),updateViewRectangle(),void changeZoom_updateMapLocations())}function revertZoom(){currentWorldmapImageWidth=oldMapImageWidth,zoom=oldZoom}function updateViewRectangle(i,t){if(isDefined(i)){var n,e;null!=i?(n=Math.abs(i),e=Math.abs(t)):(n=Math.abs(i.x),e=Math.abs(t.y)),currentWorldmapView.x=n,currentWorldmapView.y=e}currentWorldmapView.width=WORLDMAP_CANVAS_WIDTH/zoom,currentWorldmapView.height=WORLDMAP_CANVAS_HEIGHT/zoom}function getMapOffsetPixelsX(){return currentWorldmapView.x}function getMapOffsetPixelsY(){return currentWorldmapView.y}function changeZoom_updateMapLocations(){recalculateWorldmapLocationVariables();var i=$(".worldmap-location");$.each(i,function(i,t){var n=$("#"+t.id),e=n.attr("variableName"),o=n.attr("variableIndex"),a=window[e][o];n.css("width",WORLDMAP_LOCATION_SIZE+"px"),n.css("height",WORLDMAP_LOCATION_SIZE+"px");var r=getCanvasCoordinatesFromMapCoordinates(a.location.x,a.location.y);n.css("left",r.canvasX-WORLDMAP_LOCATION_SIZE/2),n.css("top",r.canvasY-WORLDMAP_LOCATION_SIZE/2)}),$(".worldmap-location label").css("margin-top",WORLDMAP_LOCATION_LABEL_MARGIN_TOP+"px")}function getWorldmap(){return null!=worldmap?worldmap:worldmap=$(".worldmap")}function initializeWorldmap(){var i=$(".worldmap");i.css("background-image",'url("/img/map/map.jpg")')}ACTION_IDLE="aa",ACTION_WALK="ab",ACTION_CLIMB_UP="ae",ACTION_PICK_UP="ak",ACTION_USE="al",ACTION_DODGE="an",ACTION_HIT="ao",ACTION_HIT2="ap",ACTION_HAND_COMBAT="aq",ACTION_KICK="ar",ACTION_THROW="as",ACTION_RUN="at",ACTION_RANDOM_STATIC="RANDOM_STATIC",SPEAR_IDLE="ga",SPEAR_WALK="gb",SPEAR_EQUIP="gc",SPEAR_UNEQUIP="gd",SPEAR_DODGE="ge",SPEAR_THRUST="gf",SPEAR_THROW="gm",SPEAR_RANDOM="RANDOM_SPEAR",WEAPON_SPEAR="SPEAR",WEAPON_10MM_PISTOL="10MM",DIR_W="w",DIR_E="e",DIR_NW="nw",DIR_NE="ne",DIR_SW="sw",DIR_SE="se",DIR_ALL=[DIR_W,DIR_E,DIR_NW,DIR_NE,DIR_SW,DIR_SE],WARRIOR_MALE="warr",WARRIOR_FEMALE="prim",SEX_GIRL="/img/special/sex-girl.png",NATURE_TREE="nature_tree",NATURE_GRASS="nature_grass",MALE="nm",FEMALE="nf";var BASE_IMG_DIR="/img/critter/",WALK_ANIMATION_LENGTH=800,WALK_ANIMATION_MODIFIER_WHEN_FIRST=100,allUnits=[],numOfImages=[];numOfImages.grass=5,numOfImages.misc=5,numOfImages.tree=6,__firstFreeUnitId=100;var mouseIsClicked=!1,mousePreviousPosition=null,mouseHasMoved=!1,WORLDMAP_LOCATION_SIZE_MODIFIER=35,WORLDMAP_LOCATION_SIZE=null,WORLDMAP_LOCATION_LABEL_MARGIN_TOP=null,MOUSE_DRAG_MODIFIER=1,_worldmapObjects=[];WENGINE_DEFAULT_LINE_WIDTH=2,window.initQueue.push(function(){setTimeout(function(){var i=jQuery.extend({},currentWorldmapView),t=2;i.x+=t,i.y+=t,i.width-=2*t+WENGINE_DEFAULT_LINE_WIDTH,i.height-=2*t+WENGINE_DEFAULT_LINE_WIDTH,i.width/=zoom,i.height/=zoom,WEngine_paintRectangleFromArray(i,{"background-color":"yellow"})},160)});var WORLDMAP_IMAGE_INITIAL_WIDTH=3500,WORLDMAP_IMAGE_INITIAL_X=150,WORLDMAP_IMAGE_INITIAL_Y=100,MIN_ZOOM_VALUE=.58,zoom=1,zoomStep=150,currentWorldmapView=null,currentWorldmapImageWidth=null,currentWorldmapImageHeight=null,oldMapImageWidth=null,oldZoom=null,WORLDMAP_WIDTH=3500,WORLDMAP_HEIGHT=3500,WORLDMAP_CANVAS_WIDTH=null,WORLDMAP_CANVAS_HEIGHT=null,WORLDMAP_CANVAS_MARGIN_LEFT=null,WORLDMAP_CANVAS_MARGIN_TOP=null,worldmap=null;window.initQueue.push(function(){setTimeout(function(){WORLDMAP_CANVAS_WIDTH=$(".worldmap").width(),WORLDMAP_CANVAS_HEIGHT=$(".content-wrapper").height(),WORLDMAP_CANVAS_MARGIN_LEFT=$(".sidebar").width(),WORLDMAP_CANVAS_MARGIN_TOP=$(".main-header").height(),initializeWorldmap(),initializeWorldmapZoom(),initializeWorldmapLocations(),initializeWorldmapEvents()},80)});