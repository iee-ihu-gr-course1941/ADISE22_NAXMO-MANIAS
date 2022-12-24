<html>
    <head>
    <title>test</title>
    <script>
        "use strict";
        let canvas;
        let context;
        let secondsPassed;
        let oldTimeStamp;
        let fps;

        window.onload = init;

        function init(){
            canvas = document.getElementById('canvas');
            context = canvas.getContext('2d');

            // Start the first frame request
            window.requestAnimationFrame(gameLoop);
        }

        function gameLoop(timeStamp){
            secondsPassed = (timeStamp - oldTimeStamp) / 1000;
            oldTimeStamp = timeStamp;

            // Calculate fps
            fps = Math.round(1 / secondsPassed);

            // Draw number to the screen
            context.fillStyle = 'white';
            context.fillRect(0, 0, 200, 100);
            context.font = '25px Arial';
            context.fillStyle = 'black';
            context.fillText("FPS: " + fps, 10, 30);
            draw();

            // Keep requesting new frames
            window.requestAnimationFrame(gameLoop);
        }

        function draw(){
            let randomColor = Math.random() > 0.5? '#ff8080' : '#0099b0';
            context.fillStyle = randomColor;
            context.fillRect(100, 50, 200, 175);
        }
    </script>

    </head>
    <body>
        <canvas id="canvas" width="300" height="300"></canvas>
    </body>
</html>