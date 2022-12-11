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
            draw2();

            // Keep requesting new frames
            window.requestAnimationFrame(gameLoop);
        }

        function draw(){
            context.lineWidth=1;

            context.beginPath();
            //x=40(oloy to sxhmatos) y=100(olou toy sxhmatos) z=100(platos) w=170(ypsos toy schmatos) [klhsh gwnias=10(panta)]
            context.roundRect(10, 100, 100, 170, [10]);
            context.stroke();

            context.lineWidth=3;
            context.beginPath();
            //x=50 y=185
            context.moveTo(20,185);
            context.lineCap = 'round';
            //x=130 y=185
            context.lineTo(100,185);
            context.stroke();
        }

        function draw2(){
            context.lineWidth=1;

            context.beginPath();
            //x=40(oloy to sxhmatos) y=100(olou toy sxhmatos) z=100(platos) w=170(ypsos toy schmatos) [klhsh gwnias=10(panta)]
            context.roundRect(120, 170, 170, 100, [10]);
            context.stroke();
            
            context.lineWidth=3;
            context.beginPath();
            //x=50 y=185
            context.moveTo(202,180);
            context.lineCap = 'round';
            //x=130 y=185
            context.lineTo(202,260);
            context.stroke();
        }
    </script>

    </head>
    <body>
        <canvas id="canvas" width="300" height="300"></canvas>
    </body>
</html>