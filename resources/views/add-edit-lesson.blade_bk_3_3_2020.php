@extends('layouts.user-layout')

@section('mainSection')


<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="/lessons">Lessons</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Lesson</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>Add Lesson</h5>

                    </div>
                    <div class="table-responsive">

                    <div class="table-container">

                        
                        <form class="add-edit-lesson" name="add-edit-lesson" method="POST" action="{{url('lesson/insert')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Lesson Name</label>
                                <div class="col-sm-6">
                                    <input name="lesson_name" id="lesson_name" placeholder="Enter the lesson name" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleSelect" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-6">
                                    <select name="select" id="exampleSelect" class="form-control">
                                    @isset($catRows)
                                        @foreach($catRows as $catRow)
                                            <option value="{{$catRow->id}}">{{$catRow->name}}</option>
                                        @endforeach
                                    @endisset
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleSelectMulti" class="col-sm-2 col-form-label">Prerequisite</label>
                                <div class="col-sm-6">
                                        <div class="selectBox" onclick="showCheckboxes()">
                                            <select name="select" id="exampleSelect" class="form-control">
                                                <option>Select an option</option>
                                            </select>
                                            
                                            <div class="overSelect"></div>
                                        </div>
                                        <div id="checkboxes">
                                            <label for="one">
                                                <input type="checkbox" name="prereq[]" value="one" id="one" />&nbsp;Prerequisite 1
                                            </label>
                                            <label for="two">
                                                <input type="checkbox" name="prereq[]" value="two" id="two" />&nbsp;Prerequisite 2
                                            </label>
                                            <label for="three">
                                                <input type="checkbox" name="prereq[]" value="three" id="three" />&nbsp;Prerequisite 3
                                            </label>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleSelect" class="col-sm-2 col-form-label">Number of Steps</label>
                                <div class="col-sm-6" style="display: inherit;">
                                    <button type="button" class="btn btn-outline-dark" id="decrease-course">-</button>&nbsp;
                                    
                                    <input style="width:10%;text-align:center;" class="form-control" id="course-step" name="course_step" value="1" disabled></input>&nbsp;
                                    <button type="button" class="btn btn-outline-dark" id="increase-course">+</button>
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    Number of Quizes
                                </label>
                                <div class="col-sm-6" style="display: inherit;">
                                    <button type="button" class="btn btn-outline-dark" id="decrease-quiz">-</button>&nbsp;
                                    
                                    <input style="width:10%;text-align:center;" class="form-control" id="quiz-step" name="quiz_step" value="1" disabled></input>&nbsp;
                                    <button type="button" class="btn btn-outline-dark" id="increase-quiz">+</button>
                                </div>
                            </div>

                            <div class="position-relative row form-group step-section">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    <input class="step-switch" type="checkbox" name="course_step1" value="step1" id="step1" />
                                    Step 1:
                                </label>
                                <div class="col-sm-6 file-section disable">
                                    <div class="image-section">
                                        <label>Image</label>
                                        <input name="course_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="course_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="course_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="course_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="course_image[]" id="lesson_image" type="file" class="form-control-file">
                                    </div>
                                    <div class="audio-section">
                                        <label>Audio</label>
                                        <input name="course_audio" id="course_audio" type="file" class="form-control-file">
                                    </div>
                                    
                                    
                                </div>
                               
                            </div>
                            


                            
                            <div class="position-relative row form-group">
                                <label for="exampleFile" class="col-sm-2 col-form-label">
                                <input class="step-switch" type="checkbox" name="course_step1" value="step1" id="step1" />
                                    Upload Image
                                </label>
                                <div class="col-sm-6">
                                    <input name="course_image" id="lesson_image" type="file" class="form-control-file">
                                    <!-- <small class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small> -->
                                </div>
                                
                                <!-- <div class="col-sm-2">&nbsp;</div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-dark btn-sm" id="increase-quiz">Add more image</button>
                                </div> -->
                            </div>

                            <div class="position-relative row form-group"><label for="exampleFile" class="col-sm-2 col-form-label">Upload Audio</label>
                                <div class="col-sm-6">
                                    <input name="course_audio" id="course_audio" type="file" class="form-control-file">
                                </div>
                            </div>
                            
                            
                            <div class="d-block text-center card-footer">
                        
                                <button class="btn-wide btn btn-success" id="saveLessonBtn" type="submit">Save Lesson</button>
                            </div>
                        </form>

                    </div>
                    

                   

                  </div>

                </div>
            </div>

        </div>

    </div>
    <!-- @include('includes/footer') -->
  </div>

  <script>
  //$(document).ready(function(){
    $('.step-switch').click(function(){
        var t = $(this);
        var fileSection = t.parent().next('div .file-section');
        if ( t.prop('checked') == true ) {
            
            fileSection.removeClass('disable');
            //console.log(test);
          }
          else {
            //alert('unchecked');
            fileSection.addClass('disable');
          }
    });


        var expanded = false;

        function showCheckboxes() {
            //alert("hello");
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }

        $(document).on('click','#increase-course', function(){
            var courseNo = $("#course-step");
            var num = parseFloat(courseNo.val());
            if(num<5){
                var newValue = parseFloat(num+1);
            }else{
                return;
            }
            courseNo.val(newValue);
         });

        $(document).on('click','#decrease-course', function(){
            var courseNo = $("#course-step");
            var num = parseFloat(courseNo.val());
            if(num>1){
                var newValue = parseFloat(num-1);
            }else{
                return;
            }
            courseNo.val(newValue);
       });

       //for quizes
       $(document).on('click','#increase-quiz', function(){
            var quizNo = $("#quiz-step");
            var num = parseFloat(quizNo.val());
            if(num<5){
                var newValue = parseFloat(num+1);
            }else{
                return;
            }
            quizNo.val(newValue);
         });

        $(document).on('click','#decrease-quiz', function(){
            var quizNo = $("#quiz-step");
            var num = parseFloat(quizNo.val());
            if(num>1){
                var newValue = parseFloat(num-1);
            }else{
                return;
            }
            quizNo.val(newValue);
       });



  //});

  </script>





@endsection
