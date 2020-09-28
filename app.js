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
        init: function() {
            const tbody = document.querySelector("table#board tbody");
            if (tbody) {
                var s = 0, out = '';
                for (var r=0; r<12; r++) {
                    out += "<tr>";
                    soil = "soil" + s;

                    if ((r == 2) || (r==5) || (r==8)) {
                        s++;
                    }
                    
                    for (var c=0; c<21; c++) {
                        out += "<td class='square " + soil + "' id='r" + r + "c" + c + "'> </td>";
                    }
                    out += "</tr>";
                }
                tbody.innerHTML = out;
                
            }
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

        },
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
    game.init();
})();

