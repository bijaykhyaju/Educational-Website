<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lesson One - Second Exercise</title>
    <link rel="stylesheet" href="{{asset('css/lessonone-b.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <script>
    $(document).ready(function() {
      $("#lessonone-b").get(0).play();
    });
    function repeatLesson() {
      $("#sound").show();
      $("#next").show();
      $("#back").show();
      $("#repeatlesson-all")[0].play();
    }
    function playLesson() {
      $("#repeatlesson-all")[0].pause();
      $("#lessonone-b")[0].play();
    }
    function checkFirstListen() {
      if ($("#sound").css("display") == "none") {
        repeatLesson();
      }
    }
    function goToNextStep() {
      window.location = "./lessonone-c";
    };
    function goToPreviousStep() {
      window.location = "./lessonone-a";
    };
    </script>
    <audio id="lessonone-b" src="audios/lessonone-b.mp3" onended="checkFirstListen()"></audio>
    <audio id="repeatlesson-all" src="audios/repeatlesson-all.mp3"></audio>
    <div id="left">
      <img src="images/lessonone-b-image.gif"/>
    </div>
    <div id="right">
      <div id="right-top">
        <div id="top-left">
          <img src="images/lessonone-b-number.svg"/>
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
