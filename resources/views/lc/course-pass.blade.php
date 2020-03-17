<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>You Passed the Course!</title>
    <link rel="stylesheet" href="{{asset('css/quiz-result.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <script>
    $(document).ready(function() {
      $("#course-pass").get(0).play();
    });
    </script>
    <audio id="course-pass" src="audios/course-pass.mp3"></audio>
    <div id="image">
      <img src="images/course-pass.gif"/>
    </div>
  </body>
</html>
