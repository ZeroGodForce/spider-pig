<!DOCTYPE html>

<html>

<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121647007-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-121647007-2');
    </script>

    <meta property="og:image" content="https://pacman-e281c.firebaseapp.com/img/preview.png">
    <meta property="og:url" content="https://pacman-e281c.firebaseapp.com/">
    <meta property="og:description" content="Pac-Man game written in HTML5 + CSS3 + jQuery with Canvas. This WebApp is a Responsive Web Design (RWD) website.">
    <meta property="og:title" content="Lucio PANEPINTO - Pac-Man">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="Pac-Man game written in HTML5 + CSS3 + jQuery with Canvas. This WebApp is a Responsive Web Design (RWD) website." />
    <meta name="keywords" content="pacman, pac-man, pac-man online, pacman online, online, online games, games, free, puzzle, lucio panepinto, lucio, panepinto, html, html5, css, css3, javascript, jquery, rwd, responsive, responsive web design, responsive web, web design, canvas, draw" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/pacman.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pacman-home.css') }}" />

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <!--<script type="text/javascript" src="js/jquery-mobile.js"></script>-->
    <script type="text/javascript" src="{{ asset('js/jquery-buzz.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/game.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tools.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/board.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/paths.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bubbles.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fruits.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pacman.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ghosts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sound.js') }}"></script>

    <script type="text/javascript">

        function simulateKeyup(code) {
            var e = jQuery.Event("keyup");
            e.keyCode = code;
            jQuery('body').trigger(e);
        }
        function simulateKeydown(code) {
            var e = jQuery.Event("keydown");
            e.keyCode = code;
            jQuery('body').trigger(e);
        }

        $(document).ready(function() {
            //$.mobile.loading().hide();
            loadAllSound();

            HELP_TIMER = setInterval('blinkHelp()', HELP_DELAY);

            initHome();

            $(".sound").click(function(e) {
                e.stopPropagation();

                var sound = $(this).attr("data-sound");
                if ( sound === "on" ) {
                    $(".sound").attr("data-sound", "off");
                    $(".sound").find("img").attr("src", "{{ asset('img/sound-off.png') }}");
                    GROUP_SOUND.mute();
                } else {
                    $(".sound").attr("data-sound", "on");
                    $(".sound").find("img").attr("src", "{{ asset('img/sound-on.png') }}");
                    GROUP_SOUND.unmute();
                }
            });

            $(".help-button, #help").click(function(e) {
                e.stopPropagation();
                if (!PACMAN_DEAD && !LOCK && !GAMEOVER) {
                    if ( $('#help').css("display") === "none") {
                        $('#help').fadeIn("slow");
                        $(".help-button").hide();
                        if ( $("#panel").css("display") !== "none") {
                            pauseGame();
                        }
                    } else {
                        $('#help').fadeOut("slow");
                        $(".help-button").show();
                    }
                }
            });

            $(".github,.putchu").click(function(e) {
                e.stopPropagation();
            });

            $("#home").on("click touchstart", function(e) {
                if ( $('#help').css("display") === "none") {
                    e.preventDefault();
                    simulateKeydown(13);
                }
            });
            $("#control-up, #control-up-second, #control-up-big").on("mousedown touchstart", function(e) {
                e.preventDefault();
                simulateKeydown(38);
                simulateKeyup(13);
            });
            $("#control-down, #control-down-second, #control-down-big").on("mousedown touchstart", function(e) {
                e.preventDefault();
                simulateKeydown(40);
                simulateKeyup(13);
            });
            $("#control-left, #control-left-big").on("mousedown touchstart", function(e) {
                e.preventDefault();
                simulateKeydown(37);
                simulateKeyup(13);
            });
            $("#control-right, #control-right-big").on("mousedown touchstart", function(e) {
                e.preventDefault();
                simulateKeydown(39);
                simulateKeyup(13);
            });


            $("body").keyup(function(e) {
                KEYDOWN = false;
            });

            $("body").keydown(function(e) {

                if (HOME) {

                    initGame(true);

                } else {
                    //if (!KEYDOWN) {
                    KEYDOWN = true;
                    if (PACMAN_DEAD && !LOCK) {
                        erasePacman();
                        resetPacman();
                        drawPacman();

                        eraseGhosts();
                        resetGhosts();
                        drawGhosts();
                        moveGhosts();

                        blinkSuperBubbles();

                    } else if (e.keyCode >= 37 && e.keyCode <= 40 && !PAUSE && !PACMAN_DEAD && !LOCK) {
                        if ( e.keyCode === 39 ) {
                            movePacman(1);
                        } else if ( e.keyCode === 40 ) {
                            movePacman(2);
                        } else if ( e.keyCode === 37 ) {
                            movePacman(3);
                        } else if ( e.keyCode === 38 ) {
                            movePacman(4);
                        }
                    } else if (e.keyCode === 68 && !PAUSE) {
                        /*if ( $("#canvas-paths").css("display") === "none" ) {
                            $("#canvas-paths").show();
                        } else {
                            $("#canvas-paths").hide();
                        }*/
                    } else if (e.keyCode === 80 && !PACMAN_DEAD && !LOCK) {
                        if (PAUSE) {
                            resumeGame();
                        } else {
                            pauseGame();
                        }
                    } else if (GAMEOVER) {
                        initHome();
                    }
                    //}
                }
            });
        });
    </script>

    <title>Lucio PANEPINTO - Pac-Man</title>
</head>

<body>

<div id="sound"></div>

<div id="help">
    <h2>Help</h2>
    <table align="center" border="0" cellPadding="2" cellSpacing="0">
        <tbody>
        <tr><td>Arrow Left : </td><td>Move Left</td></tr>
        <tr><td>Arrow Right : </td><td>Move Right</td></tr>
        <tr><td>Arrow Down : </td><td>Move Down</td></tr>
        <tr><td>Arrow Up : </td><td>Move Up</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td>P : </td><td>PAUSE</td></tr>
        </tbody>
    </table>
</div>

<div id="home">
    <h1>pac-man</h1>
    <h3>Lucio PANEPINTO<br><em>2015</em></h3>
    <canvas id="canvas-home-title-pacman"></canvas>
    <div id="presentation">
        <div id="presentation-titles">character &nbsp;/&nbsp; nickname</div>
        <canvas id="canvas-presentation-blinky"></canvas><div id="presentation-character-blinky">- shadow</div><div id="presentation-name-blinky">"blinky"</div>
        <canvas id="canvas-presentation-pinky"></canvas><div id="presentation-character-pinky">- speedy</div><div id="presentation-name-pinky">"pinky"</div>
        <canvas id="canvas-presentation-inky"></canvas><div id="presentation-character-inky">- bashful</div><div id="presentation-name-inky">"inky"</div>
        <canvas id="canvas-presentation-clyde"></canvas><div id="presentation-character-clyde">- pokey</div><div id="presentation-name-clyde">"clyde"</div>
    </div>
    <canvas id="trailer"></canvas>
    <div class="help-button">- help -</div>
    <a class="sound" href="javascript:void(0);" data-sound="on"><img src="{{ asset('img/sound-on.png') }}" alt="" border="0"></a>
    <a class="github" target="_blank" href="https://github.com/luciopanepinto/pacman"><img src="{{ asset('img/github.png') }}" alt="GitHub - Lucio PANEPINTO - Pac-Man"></a>
    <a class="putchu" target="_top" href="http://www.putchu.be"><img src="http://www.putchu.be/img/intro/player.png" height="95px" alt="Putchu">www.putchu.be</a>
</div>

<div id="panel">
    <h1>pac-man</h1>
    <a class="putchu" target="_top" href="http://www.putchu.be"><img src="http://www.putchu.be/img/intro/player.png" height="65px" alt="Putchu">www.putchu.be</a>
    <canvas id="canvas-panel-title-pacman"></canvas>
    <div id="score"><h2>1UP</h2><span>00</span></div>
    <div id="highscore"><h2>High Score</h2><span>00</span></div>
    <div id="board">
        <canvas id="canvas-board"></canvas>
        <canvas id="canvas-paths"></canvas>
        <canvas id="canvas-bubbles"></canvas>
        <canvas id="canvas-fruits"></canvas>
        <canvas id="canvas-pacman"></canvas>
        <canvas id="canvas-ghost-blinky"></canvas>
        <canvas id="canvas-ghost-pinky"></canvas>
        <canvas id="canvas-ghost-inky"></canvas>
        <canvas id="canvas-ghost-clyde"></canvas>
        <div id="control-up-big"></div>
        <div id="control-down-big"></div>
        <div id="control-left-big"></div>
        <div id="control-right-big"></div>
    </div>
    <div id="control">
        <div id="control-up"></div>
        <div id="control-up-second"></div>
        <div id="control-down"></div>
        <div id="control-down-second"></div>
        <div id="control-left"></div>
        <div id="control-right"></div>
    </div>
    <canvas id="canvas-lifes"></canvas>
    <canvas id="canvas-level-fruits"></canvas>
    <div id="message"></div>
    <div class="help-button">- help -</div>
    <a class="sound" href="javascript:void(0);" data-sound="on"><img src="{{ asset('img/sound-on.png') }}" alt="" border="0"></a>
</div>

</body>

</html>
