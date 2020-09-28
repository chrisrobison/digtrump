<!doctype html>
<html>
<head>
<title>Dig, Trump, Dig!</title>
<style>
body,h1,h2,h3,h4,h5,ul,li,p,div,span,table,td,tr,thead,tbody,hr,blockquote,code,pre,input,textarea { padding:0; margin:0; font-size:18px; background-color:#666; overflow:hidden; }
.trump {
    position:absolute;
    width:80px; 
    height:80px;
    display:inline-block; 
    background-position: 0px 0px;
    background-color:transparent;
    transition: left 50ms, top 50ms
}
.trump-walk.down {
    animation: walking-down 1s steps(10) infinite;
}
.trump-walk.right {
    animation: walking-right 1s steps(10) infinite;
}
.trump-walk.up {
    animation: walking-up 1s steps(10) infinite;
}
.trump-walk.left {
    animation: walking-left 1s steps(10) infinite;
}

.trump-idle.down {
    animation: idling-down 1s steps(10) infinite;
}
.trump-idle.right {
    animation: idling-right 1s steps(10) infinite;
}
.trump-idle.up {
    animation: idling-up 1s steps(10) infinite;
}
.trump-idle.left {
    animation: idling-left 1s steps(10) infinite;
}


.trump-run.down {
    animation: running-down 1s steps(6) infinite;
}
.trump-run.right {
    animation: running-right 1s steps(6) infinite;
}
.trump-run.up {
    animation: running-up 1s steps(6) infinite;
}
.trump-run.left {
    animation: running-left 1s steps(6) infinite;
}

.soil0 {
    background-color:#ffbb00;
}
.soil1 {
    background-color:#f36800;
}
.soil2 {
    background-color:#cc0000;
}
.soil3 {
    background-color:#9f0000;
}

.trump-walk {
    background-image:url("walk2.png");
    background-size:800px 320px;;
}
.trump-run {
    background-image:url("run2.png");
    background-size:480px 320px;;
}
.trump-idle {
    background-image:url("idle2.png");
    background-size:800px 320px;;
}

@keyframes running-up {
    0% { background-position: 0px 0px; }
    100% { background-position: -480px 0px; }
}
@keyframes running-right {
    0% { background-position: 0px -80px; }
    100% { background-position: -480px -80px; }
}
@keyframes running-down {
    0% { background-position: 0px -160px; }
    100% { background-position: -480px -160px; }
}
@keyframes running-left {
    0% { background-position: 0px -240px; }
    100% { background-position: -480px -240px; }
}

@keyframes idling-up {
    0% { background-position: 0px 0px; }
    100% { background-position: -800px 0px; }
}
@keyframes idling-right {
    0% { background-position: 0px -80px; }
    100% { background-position: -800px -80px; }
}
@keyframes idling-down {
    0% { background-position: 0px -160px; }
    100% { background-position: -800px -160px; }
}
@keyframes idling-left {
    0% { background-position: 0px -240px; }
    100% { background-position: -800px -240px; }
}


@keyframes walking-up {
    0% { background-position: 0px 0px; }
    100% { background-position: -800px 0px; }
}
@keyframes walking-right {
    0% { background-position: 0px -80px; }
    100% { background-position: -800px -80px; }
}
@keyframes walking-down {
    0% { background-position: 0px -160px; }
    100% { background-position: -800px -160px; }
}
@keyframes walking-left {
    0% { background-position: 0px -240px; }
    100% { background-position: -800px -240px; }
}

.sky {
   background: linear-gradient(to bottom, #57c1eb 0%, #246fa8 100%);
   text-align:center;
   height:5.6rem;
   overflow:hidden;
}

#board {
    width:100%;
    margin:0px auto;
    border-collapse: collapse;
    top:0px;
}
#board td {
    width:80px;
    height:64px;
}
#run { 
    display:none;
}
#idle {
    display:block;
}
#walk {
    display:none;
}
#flag {
    position:absolute;
    left:50%;
    z-index:999;
    top:0px;
    width:24px;
    height:18px;
}
#whitehouse {
    position:relative;
    top:-10px;
}
#board .black {
    background-color:#000000 !important;
    background-image:none !important;
}
.square {
    background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQ4IDc5LjE2NDAzNiwgMjAxOS8wOC8xMy0wMTowNjo1NyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjZBRUJEQzZBMTJGMTFFQUIxMzVEODYzOTlBNThBNTgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjZBRUJEQzdBMTJGMTFFQUIxMzVEODYzOTlBNThBNTgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBRjE4NkNGRkEwQzAxMUVBQjEzNUQ4NjM5OUE1OEE1OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBRjE4NkQwMEEwQzAxMUVBQjEzNUQ4NjM5OUE1OEE1OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv1iOBEAAAJDSURBVHja5FqLbsMgDGwQH54/z9opRFkezA/ucApS1FZLApzP9tnjtSzLa5Tx3uu8XuX3Kx9uGAKIaZrm8pmA88zrxX5W9d7pY/U3EggGFJS334r3e56VMGD7noDoR2TAGYwLBtTQnw+fKrS1VvQ8Kx35jn61TZYg0pqaXnezsOY2BtTQjwqAJWZYAQiZOi2GMWUBAQBmSraK7tK9ZKOiglmEHR9ytKDklLpqYyCFkJSSUrBcoFYBQFlMA4AggrvU4d1aMtJnhe+gMKCaBSIELWkEb52CJ2nuR1ujFwD5+FK08PCm1tbMtDZEuqQ5RIp2pcGoklhTN4wIwB/3hXeEorpJ2XNmIQ1OrWawMyvYRCuHy9+htQA7TtD6ASQA1Ayi9QMQAqdXDMm7hUoQZ/q1ei4LQJsLFAD+KTddJWnEGJIOm5OUpE+Uv7fr3zNAjHgABWh1xROD09WmGMi3Snvr5WcA2JqQ2GHNEHvAWABAUprVFXsC0DR2tHgfXAghg1yzlhhrGPoN8EoyBWYARW9QY0DESjI91XKt5ssgyzXxXcZ/oYdnACQGsGsFw3zzqRYYcfzWERUGMJsfcQFgNj96pNkUtPkRRwh1an542Kdy3UcXQy20AbUhot2Q85yxHABCxDdRmnHQGnpIyssAiohiHpKKeJ7AekjqawBwHZJCVXd0ACIvED0iFEM9FadICFGKol6nVHOABXatOsVKUAEAS/Vp57m8XwOAdIEs1aed5/L+DIj+LNXXjgEjj6F7gp/xI8AA5/hBOWah1pUAAAAASUVORK5CYII=);}
.safe {
    background-color:#333;
    background-image:none;
}
#crowd {
    position:absolute;
    z-index:9999;
    height:64px;
    top:27px;
    left:28%;
    display:none;
}
.protester {
    position:absolute; 
    height:128px;
    top:0px;
}
.burger { width:42px; }
.fries { height:42px; }
.soda { width:38px; }
#score {
    position:absolute;
    top:0px;
    z-index:99999;
    padding:.25em;
    right: 0px;
    font-size:48px;
    height:4.2rem;
    color:#00cc00;
    background-color:#000000a0;
}
#protester1 { left:10%; }
#protester2 { left:25%; }
#protester3 { left:75%; }
#vault {
    position:absolute;
    bottom:46px;
    right:4px;
    height:128px;
}
.tweet {
    position:absolute;
    z-index:9999;
    height:64px;
    transition: all 1ms;
}
#church {
    position:absolute;
    top:-12px;
    left:2em;
    height:118px;
    
    width: 100px;
}
</style>
<script>
</script>
</head>
<body>
    <!--
    <div id='run' class='trump trump-run down'></div>
    <div id='idle' class='trump trump-idle down'></div>
    <div id='walk' class='trump trump-walk down'></div><br>
    <div id='run' class='trump trump-run left'></div>
    <div id='idle' class='trump trump-idle left'></div>
    <div id='walk' class='trump trump-walk left'></div><br>
    <div id='run' class='trump trump-run right'></div>
    <div id='idle' class='trump trump-idle right'></div>
    <div id='walk' class='trump trump-walk right'></div><br-->
<div class='sky'><img src='flag.gif' id='flag' width='32' height='24'><img src='whitehouse.png' id='whitehouse' width='256' height='100'>
<img src='church.png' id='church'>
<img src='crowd1.gif' id='crowd'><img src='protester1.gif' id='protester1' class='protester'>
<img src='protester2.gif' id='protester2' class='protester'>
<img src='protester3.gif' id='protester3' class='protester'>
<div id='score'>$ 0.00</div>
</div>

</div>
<table id='board'>
<tbody>
<?php
    $s = 0;
    for ($r=0; $r<12; $r++) {
        print "<tr>";
        $soil = "soil" . $s;

        if ($r == 2) {
            $s++;
        } else if ($r == 5) {
            $s++;
        } else if ($r == 8) {
            $s++;
        }
         
        for ($c=0; $c<21; $c++) {
            print "<td class='square $soil ' id='r{$r}c{$c}'> </td>";
        }
        print "</tr>\n";
    }
?>
</tbody>
</table>
<img src='vault.png' id='vault'>
<div id='run' class='trump trump-run up'></div>
<div id='idle' class='trump trump-idle up'></div>
<div id='walk' class='trump trump-walk up'></div>

<script>

(function() {
    const game = {
        direction: "up",
        speed: "idle",
        step: 6,
        position: { x:Math.floor((window.innerWidth - 64) / 2), y:90 - 64},
        cell: {
            width: Math.floor(window.innerWidth / 21),
            height: Math.floor(((window.innerHeight - 86) / 12) + 2)
        },
        objects: {},
        firing: 0,
        fire: function(dir) {
            var tweet = new Image();
            tweet.className = 'tweet';
            tweet.src = 'tweet.gif';
            tweet.style.position = 'absolute';
            tweet.style.top = game.position.y + 'px';
            tweet.style.left  = game.position.x + 'px';
            var x = 0, y = 0;
            if (game.direction == 'left') {
                tweet.style.left = (game.position.x - 32) + 'px';
                tweet.style.transform = "scaleX(-1)";
                x = -1;
            } else if (game.direction == 'right') {
                tweet.style.left = (game.position.x + 32 ) + 'px';
                x = 1;
            } else if (game.direction == 'down') {
                tweet.style.transform = "rotate(-90deg)";
                tweet.style.top = (game.position.y - 32) + 'px';
                y = -1;
            } else if (game.direction == 'up') {
                tweet.style.transform = "rotate(90deg)";
                tweet.style.top = (game.position.y + 32) + 'px';
                y = 1;
            }
            document.documentElement.append(tweet);
            game.moveFire(tweet, x, y);
        },
        moveFire: function(tweet, x, y) { 
            tweet.style.top = parseInt(tweet.style.top) + (y * 16) + 'px';
            tweet.style.left = parseInt(tweet.style.left) + (x * 16) + 'px';

            if (((parseInt(tweet.style.top) > 0) && (parseInt(tweet.style.top) < window.innerHeight)) && ((parseInt(tweet.style.left) > 0) && (parseInt(tweet.style.left) < window.innerWidth))) { 
                setTimeout(function() { game.moveFire(tweet, x, y); }, 50);
            } else {
                setTimeout(function() { tweet.parentElement.removeChild(tweet); game.firing--; }, 50);
            }
        }
    };
    window.game = game;
    const run = document.querySelector("#run");
    const walk = document.querySelector("#walk");
    const idle = document.querySelector("#idle");
    const sprites = { "run": run, "walk": walk, "idle": idle};
    game.sprites = sprites;

    idle.style.left = game.position.x + 'px';
    idle.style.top = game.position.y + 'px';

    document.addEventListener("keydown", function(e) {
        console.dir(e);
        const oldspeed = game.speed;
        const key = e.keyCode;
        const run = document.querySelector("#run");
        const walk = document.querySelector("#walk");
        const idle = document.querySelector("#idle");
        
        if (key == 38) {
            game.direction = 'down';
            game.position.y -= game.step;
            game.speed = 'walk';
            console.log("Going down! " + game.position.y);
        } else if (key == 39) {
            game.direction = 'right';
            game.position.x += game.step;
            game.speed = 'walk';
            console.log("Going right!" + game.position.x);
        } else if (key == 37) {
            game.direction = 'left';
            game.position.x -= game.step;
            game.speed = 'walk';
            console.log("Going left!" + game.position.x);
        } else if (key == 40) {
            game.direction = 'up';
            game.position.y += game.step;
            game.speed = 'walk';
            console.log("Going up!" + game.position.y);
        } else if (key == 32) {
            game.firing++;
            game.fire(game.direction);
        }

        var soil = document.querySelector('#r' + Math.round((game.position.y - 64)/ game.cell.height) + 'c' + Math.round(game.position.x / game.cell.width));

        if (soil && soil.className && !soil.className.match(/black/)) {
            soil.classList.add('black');
        }
/*
        if (!game.pressed) {
            game.pressed = new Date().getTime();
            game.step = 4;
        } else {
            var now = new Date().getTime();
            if (((now - game.pressed) / 1000) > 2) {
                game.speed = "run";
                game.step = 8;
            }
        }
*/
        if (e.shiftKey) {
            game.speed = "run";
            game.step = 10;
        } else {
            game.step = 6;
        }

        if (oldspeed != game.speed) {
            changeSpeed(game.speed);
        }
        moveTrump(game.speed);
        clearClass(sprites[game.speed], game.direction);
    });

    document.addEventListener("keyup", function(e) {
        game.speed = 'idle';
        if (game.direction==='up') {
            game.position.y -= game.step * 1;
        } else if (game.direction === 'down') {
            game.position.y += game.step * 1;
        } else if (game.direction === 'left') {
            game.position.x -= game.step * 1;
        } else if (game.direction === 'right') {
            game.position.x += game.step * 1;

        }

        changeSpeed(game.speed);
        clearClass(sprites[game.speed], game.direction);
        game.pressed = 0;
    });

    function makeFries() {
        const fries = new Image();
        fries.src = 'fries.png';
        fries.className = 'fries';
        return fries;
    }

    function makeSoda() {
        const soda = new Image();
        soda.src = 'soda.png';
        soda.className = 'soda';
        return soda;
    }

    function makeObject(type) {
        const obj = new Image();
        obj.src = type + '.png';
        obj.className = type;
        return obj;
    }

    function placeObjects(type, min=5, max=10) {
        var objCount = Math.floor(Math.random() * max) + min;
        var bx, by, bs;

        for (var b=0; b<objCount; b++) {
            bx = Math.floor(Math.random() * 20);
            by = Math.floor(Math.random() * 10);
            bs = document.querySelector("#r" + by + "c" + bx);
            if (bs) {
                bs.append(makeObject(type));
            }
        }


    }

    function init() {
        var safe = [];
        safe[0] = document.querySelector('#r9c19');
        safe[1] = document.querySelector('#r9c20');
        safe[2] = document.querySelector('#r10c19');
        safe[3] = document.querySelector('#r10c20');
        
        document.querySelector("#board").style.height = (window.innerHeight - 90) + 'px';
        safe.forEach((item) => {
            item.className += ' safe';
        });
        
        placeObjects('burger', 5, 10);
        placeObjects('fries', 5, 10);
        placeObjects('soda', 5, 10);
        
        const head = document.querySelector(".sky");
        for (var i=0; i<20; i++) {
            var img = new Image();
            img.src = "protester" + (Math.floor(Math.random()*6) + 1) + ".gif";
            img.className = "protester";
            var left = 200 + (Math.floor(Math.random() * (window.innerWidth - 400) ));
            if ((left > 650) && (left < 900)) {
                if ((left - 650) < 150) {
                    left = left - 200;
                } else {
                    left = left + 200;
                }
                console.log("Moved protester from " + (left + 200) + " to " + left);
                console.dir(img);
            }
            img.style.left = left + 'px';
            
            head.appendChild(img);
        }
    }
    function changeSpeed(newspeed)  {
        sprites.run.style.display = 'none';
        sprites.idle.style.display = 'none';
        sprites.walk.style.display = 'none';

        sprites[newspeed].style.left = game.position.x + 'px';
        sprites[newspeed].style.top = game.position.y + 'px';
        sprites[newspeed].style.display = 'block';

    }

    function moveTrump(myspeed) {
        if (!myspeed) {
            myspeed = game.speed;
        }
        sprites[myspeed].style.left = game.position.x + 'px';
        sprites[myspeed].style.top = game.position.y + 'px';
    }

    function clearClass(who, add) {
        who.className = who.className.replace(/\s*(up|down|left|right)/g, '');
        if (add) {
            who.className += " " + add;
        }
    }
    init();
})();
</script>
</body>
</html>