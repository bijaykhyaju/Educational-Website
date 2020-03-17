<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>One</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .hidden {

              display:none;

            }

            .col {
                width: 50%;
                height: 100%;
                padding: 0;
                box-sizing: border-box;
                border: 0;
                float: left;
            }


            #apple {
                width: 100%;
                height: 100%;
                box-sizing: border-box;
                border: 1px solid rgba(0,0,0,0.5);
            }

            .row {
                display: flex;
                align-items: center;
                width: 100%;
                box-sizing: border-box;
                float: right;
            }

            .btn-circle {
              width: 45px;
              height: 45px;
              text-align: center;
              padding: 0;
              border-radius: 50%;
            }

            .btn-circle-xl {
              width: 140px;
              height: 140px;
              font-size: 2.6rem;
            }

        </style>
        <script>
          function repeat() {
              $("#sound").show();
              $("#next").show();
              $('#repeat').get(0).play()
          }
        </script>
    </head>
    <body>
      <div class="col">
        <img id="apple" src="one1.gif"/>
      </div>

      <div class="col">
        <div class="row">
          <div class="col">
            <img id="num1" src="1on.png"/>
          </div>
          <div class="col">
            <audio id="one" src="lessonone.mp3" autoplay onended="repeat()"></audio>
            <audio id="repeat" src="repeat.mp3"></audio>
            <button id="sound" class="btn btn-primary btn-circle btn-circle-xl hidden" onclick= "document.getElementById('one').play();"><i class="fa fa-volume-up" text-center></i></button>
          </div>
        </div>  
        <div class="row">
          <div class="col">
            <button id="back" class="btn btn-danger btn-circle btn-circle-xl hidden" ><i class="fa fa-backward" text-center></i></button>
          </div>
          <div class="col">
            <button id="next" class="btn btn-success btn-circle btn-circle-xl hidden" ><i class="fa fa-forward" text-center></i></button>
          </div>
        </div>
      </div>  
    </body>
</html>
