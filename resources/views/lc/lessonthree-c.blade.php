<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lesson Three - Third Exercise</title>
    <link rel="stylesheet" href="{{asset('css/lessonthree-c.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <script>
    $(document).ready(function() {
      $("#lessonthree-c").get(0).play();
    });
    function showButtons() {
      $("#sound").show();
      $("#next").show();
      $("#back").show();
    }
    function playLesson() {
      $("#lessonthree-c")[0].play();
    }
    function goToNextStep() {
      window.location = "./lessonthree-quiz-a";
    };
    function goToPreviousStep() {
      window.location = "./lessonthree-b";
    };
    </script>
    <audio id="lessonthree-c" src="audios/lessonthree-c.mp3" onended="showButtons()"></audio>
    <div id="left">
      <img src="images/lessonthree-c-image.gif"/>
    </div>
    <div id="right">
      <div id="right-top">
        <div id="top-left">
          <img src="images/lessonthree-c-number.svg"/>
        </div>
        <div id="top-right">
          <button id="sound" onclick="playLesson()"><i class="fa fa-volume-up"></i></button>
        </div>
      </div>
      <div id="right-bottom">
        <div id="bottom-left">
          <button id="back" onclick="goToPreviousStep()"><i class="fa fa-arrow-left"></i></button>
        </div>
        <div id="bottom-right">
          <button id="next" onclick="goToNextStep()"><i class="fa fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </body>
</html>
