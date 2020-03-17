<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lesson Three - Second Quiz</title>
    <link rel="stylesheet" href="{{asset('css/lessonthree-quiz-b.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <script>
    $(document).ready(function() {
      $("#lessonthree-quiz-b").get(0).play();
    });
    function goToPreviousStep() {
      window.location = "./lessontwo-c";
    };
    function quizFail() {
      window.location = "./quizthree-fail";
    }
    function goToNextStep() {
      window.location = "./lessonthree-quiz-c";
    };
    function playLesson() {
      $("#lessonthree-quiz-b")[0].play();
    }
    </script>
    <audio id="lessonthree-quiz-b" src="audios/lessonthree-quiz-b.mp3"></audio>
    <div id="left">
      <div id="left-top">
        <img src="images/lessonthree-quiz-b.gif"/>
      </div>
      <div id="left-bottom">
        <button id="1" onclick="goToNextStep()">१</button>
        <button id="2" onclick="quizFail()">२</button>
        <button id="3" onclick="quizFail()">३</button>
      </div>
    </div>
    <div id="right">
      <div id="right-top">
        <button id="sound" onclick="playLesson()"><i class="fa fa-volume-up"></i></button>
      </div>
      <div id="right-bottom">
        <button id="back" onclick="goToPreviousStep()"><i class="fa fa-arrow-left"></i></button>
      </div>
    </div>
  </body>
</html>
