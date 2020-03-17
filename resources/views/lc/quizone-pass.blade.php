<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>You Passed!</title>
    <link rel="stylesheet" href="{{asset('css/quiz-result.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <script>
    $(document).ready(function() {
      $("#quiz-pass").get(0).play();
    });
    function nextNumber() {
      window.location = "./lessontwo-a";
    };
    </script>
    <audio id="quiz-pass" src="audios/quiz-pass.mp3" onended="nextNumber()"></audio>
    <div id="image">
      <img src="images/quiz-pass.gif"/>
    </div>
  </body>
</html>
