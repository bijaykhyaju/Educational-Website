<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test pagee</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <audio id="lessonone" src="../audios/lessonone.mp3" autoplay></audio>
    <div id="left">
      <img src="../images/one.gif"/>
    </div>
    <div id="right">
      <div id="right-top">
        <div id="top-left">
          <img src="../images/1.png"/>
        </div>
        <div id="top-right">
          <button id="sound"><i class="fa fa-volume-up"></i></button>
        </div>
      </div>
      <div id="right-bottom">
        <div id="bottom-left">
          <button id="back"><i class="fa fa-arrow-left"></i></i></button>
        </div>
        <div id="bottom-right">
          <button id="next"><i class="fa fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </body>
</html>
