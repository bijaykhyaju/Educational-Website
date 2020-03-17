@extends('layouts.user-layout')

@section('mainSection')




<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/home")}}'>Home</a></li>
          <li class="breadcrumb-item"><a href='{{url("/courses")}}'>Courses</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ucfirst($action)}} Course</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>{{$action}} Lesson</h5>

                    </div>
                    <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="table-container">
                            <div class="alert alert-danger" style="display:none"></div>

                            
                            <form class="add-edit-lesson" id="lesson-form" name="add-edit-lesson" enctype="multipart/form-data">
                                @csrf

                                <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-6">
                                        <input name="course_name" id="course_name" placeholder="Enter the course name" type="text" class="form-control" value="{{$lesson->name ?? ''}}">
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-6">
                                        <select name="lesson_category" id="exampleSelect" class="form-control">
                                        @isset($catRows)
                                            @foreach($catRows as $catRow)
                                                <option value="{{$catRow->id}}" @isset($lesson) @if($lesson->category == $catRow->id) {{"selected='selected'"}}  @endif @endisset >{{$catRow->name}}</option>
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
                                                    <input type="checkbox" name="prereq[]" value="one" id="one" @isset($lesson) @if(strpos($lesson->prerequisite, 'one')!== false) {{"checked"}} @endif @endisset/>&nbsp;Prerequisite 1
                                                </label>
                                                <label for="two">
                                                    <input type="checkbox" name="prereq[]" value="two" id="two"  @isset($lesson) @if(strpos($lesson->prerequisite, 'two')!== false) {{"checked"}} @endif @endisset />&nbsp;Prerequisite 2
                                                </label>
                                                <label for="three">
                                                    <input type="checkbox" name="prereq[]" value="three" id="three"  @isset($lesson) @if(strpos($lesson->prerequisite, 'three')!== false) {{"checked"}} @endif @endisset />&nbsp;Prerequisite 3
                                                </label>
                                            </div>
                                        
                                    </div>
                                </div>
                                
                                <?php 
                                $stepArray = array('course_step1', 'course_step2', 'course_step3', 'course_step4', 'course_step5');

                                for($i = 1 ; $i <= 5 ; $i++){
                                    $j = $i-1;
                                    
                                    if(isset($lesson)){

                                        //find the step of course
                                        $isStep = App\Course::getCourseByLessonIdAndCourseName($lesson->id,$stepArray[$j]);
                                        $courseRowsById = App\Course::getCourseByLessonId($lesson->id); 
                                        $courseCount = $courseRowsById->count();


                                        //get the files of steps
                                        //echo $isStep;
                                    }
                                    
                                    


                                ?>

                                <div class="position-relative row form-group step-section" @if($i>2 && $action == "add") {{"style=display:none;"}} @endif @isset($courseCount) @if($courseCount<($j) && $action == "edit") {{"style=display:none;"}} @endif @endisset>
                                    
                                    <label for="step{{$i}}" class="col-sm-2 col-form-label">
                                        <input class="step-switch" type="checkbox" name="course_step{{$i}}" value="1" id="step{{$i}}" @if($i ==1 && $action == 'add') {{'checked'}} @endif @isset($isStep) @if($action == 'edit' && $isStep!="") {{'checked'}} @endif @endisset />
                                        Step {{$i}}:
                                    </label>
                                    <div class="col-sm-6 file-section @if($i!=1 && $action == "add") {{'disable'}} @endif @isset($courseCount) @if($courseCount<($i) && $action == "edit") {{"disable"}} @endif @endisset">
                                        <div class="image-section">

                                            <label class="dis-flex">Image Files:&nbsp;<span class="hide err-msg">*Choose image file.</span></label>


                                            @for($k=1 ; $k<=5 ; $k++)

                                                <?php
                                                if(isset($courseRowsById)){
                                                    foreach($courseRowsById as $course){
                                                        if($course->name == $stepArray[$j]){
                                                            $imageRows = App\CourseFiles::getCourseImagesByCourseId($course->id);
                                                            $imageCount = $imageRows->count();
                                                            //echo($imageCount);
                                                            //$k = (5-$imageCount);
                                                            if($k<=$imageCount){
                                                                
                                                                foreach($imageRows as $imageRow){
                                                            
                                                ?>
                                                <div class="inline-flex">
                                                    
                                                    <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file_upload file_transp" value="{{$imageRow->file}}">
                                                    <span class="hide">
                                                        <button type="button" class="btn btn-outline-danger btn-sm remove-file">
                                                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                        </button>
                                                    </span>
                                                   
                                                    <label class="up-file-name">{{$imageRow->file}}
                                                        &nbsp;
                                                        <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-upload-file">
                                                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                        </button>   
                                                    
                                                    </label>
                                                    
                                                </div>

                                                <?php
                                                                }
                                                                $k= $k+$imageCount;
                                                            }
                                                        }

                                                    }
                                                }

                                         
                                                ?>

                                                <div class="inline-flex">
                                                    <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file_upload">
                                                    



                                                    
                                                    <span class="hide">
                                                        <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-file">
                                                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                        </button>
                                                    </span>
                                                    
                                                </div>

                                            @endfor

                                    
                                        </div>
                                        <div class="audio-section">
                                            
                                            <label class="dis-flex">Audio File:&nbsp;<span class="hide err-msg">*Choose audio file.</span></label>
                                        
                                    <?php
                                        if(isset($courseRowsById)){
                                            $stepCount = $courseRowsById->count();
                                            //echo $stepCount;
                                            if($stepCount>=$i){           
                                                foreach($courseRowsById as $course){
                                                
                                                    if($course->name == $stepArray[$j]){
                                                        $audioRows = App\CourseFiles::getCourseAudioByCourseId($course->id);
                                                        $audioCount = $audioRows->count();
                                                        $stepNextCount = $audioCount;
                                                        
                                                        foreach($audioRows as $audioRow){

                                                    
                                        ?>
                                                
                                                <div class="inline-flex">
                                                    <input name="step{{$i}}_audio" id="course_audio" type="file" class="form-control-file file_upload file_transp" value="{{$audioRow->file}}">
                                                    <span class="hide">
                                                        <button type="button" class="btn btn-outline-danger btn-sm remove-file">
                                                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                        </button>
                                                    </span>
                                                    <label class="up-file-name">{{$audioRow->file}}
                                                        &nbsp;
                                                        <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-upload-file">
                                                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                        </button>   
                                                    
                                                    </label>
                                                </div>
                                                

                                                <?php
                                                            }
                                                            $stepNextCount = 0;
                                                            
                                                        
                                                            
                                                            
                                                        }

                                                    }
                                                }
                                                else{
                                                ?>

                                        
                                                <div class="inline-flex">
                                                    <input name="step{{$i}}_audio" id="course_audio" type="file" class="form-control-file file_upload">
                                                    <span class="hide">
                                                        <button type="button" class="btn btn-outline-danger btn-sm remove-file">
                                                            <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                        </button>
                                                    </span>
                                                </div>
    
                                                    <?php

                                                }
                                                   
                                                     
                                                    
                                                }
                                                
                                                if($action == "add"){
                                                ?>

                                            
                                                    <div class="inline-flex">
                                                        <input name="step{{$i}}_audio" id="course_audio" type="file" class="form-control-file file_upload">
                                                        <span class="hide">
                                                            <button type="button" class="btn btn-outline-danger btn-sm remove-file">
                                                                <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                            </button>
                                                        </span>
                                                    </div>

                                                <?php } ?>
                                                

                                           
                                        </div>
                                        
                                        
                                    </div>
                                
                                </div>

                                <?php } ?>

                            
                            </form>

                        </div>
                        
                        <div class="d-block text-center card-footer">
                            <button class="btn-wide btn btn-success" id="saveLessonBtn">Add Course</button>
                        </div>
                                    
                   

                  </div>

                </div>
            </div>

        </div>

    </div>
    <!-- @include('includes/footer') -->
  </div>

  <script>
  
    $('.step-switch').click(function(){
        var t = $(this);
        var fileSection = t.parent().next('div .file-section');
        var stepSec = t.parent().parent('.step-section');
        //alert(stepSec.attr('class'));
        if ( t.prop('checked') == true ) {
            
            fileSection.removeClass('disable');
            stepSec.next('.step-section').slideDown(400);

          }
          else {
            //alert('unchecked');
            fileSection.addClass('disable');
            stepSec.next('.step-section').slideUp(400);
            var next = stepSec.next('.step-section');
            next.each(function(){
                $(this).slideUp(400);
                $(this).children('label').children('input').prop('checked', false);
                $(this).children('.file-section').addClass('disable');
                $(this).next('.step-section').each(function(){
                    $(this).slideUp(400);
                    $(this).children('label').children('input').prop('checked', false);
                    $(this).children('.file-section').addClass('disable');
                    $(this).next('.step-section').each(function(){
                        $(this).slideUp(400);
                        $(this).children('label').children('input').prop('checked', false);
                        $(this).children('.file-section').addClass('disable');
                        $(this).next('.step-section').each(function(){
                            $(this).slideUp(400);
                            $(this).children('label').children('input').prop('checked', false);
                            $(this).children('.file-section').addClass('disable');
                        });
                    });
                });
            });
            

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

        
    $(document).ready(function(){


       

        $(".file_upload").on("change", function() {
            var t = $(this);
            var btn = t.next('span');
            if ($(this).val() != "") {
                btn.removeClass('hide');
                //for removing uploaded image during edit
                t.removeClass('file_transp');
                t.siblings('label').addClass('hide').removeClass('up-file-name');

            } else {
                disappear(btn);
            }
        });

        $(".remove-upload-file").click(function() {
            var t = $(this);
            t.parent().addClass('hide').removeClass('up-file-name');
            t.parent().siblings('input').removeClass('file_transp');
        });

        $(".remove-file").click(function() {
            var btn = $(this).parent('span');
            btn.prev('.file_upload').val('');
            disappear(btn);
        });

        function disappear(btn) {
        btn.addClass('hide');
        }


        //$(document).on("click", $('#saveLessonBtn'), function(e){
        $('#saveLessonBtn').click(function(){
            var savBtn = $(this);
            var error = false;
            var name = $('#course_name');
            $('.err-msg').addClass('hide');
            name.removeClass('err-input');
            $('.image-section').each(function(){
                $(this).removeClass('err-input');
            });
            $('.audio-section').each(function(){
                $(this).removeClass('err-input');
            });
            if(name.val()==''){
                name.addClass('err-input');
                $('html, body').animate({
                    scrollTop: $(".card-header").offset().top
                }, 600);
                error = true;
                //return false;          
            }
            
            $('.step-switch').each(function(){
                var t = $(this);
                if( t.prop('checked') == true ) {
                    //console.log("Selected = "+ i);

                    //image validation
                    var fileSection = t.parent().next('div .file-section');
                    var imageSection = fileSection.children('.image-section');
                    //console.log($(imageSection).attr('class'));
                    var imageUploadCount = 0;
                    $(imageSection).children('div .inline-flex').children('input').each(function(){
                        
                        
                        if ($(this).get(0).files.length === 0) {
                            //console.log("No image files selected.");
                            console.log($(this).attr('value'));

                        }else{
                            var file = $(this).get(0).files;
                            console.log("file name = "+file);
                            //var fileType = file["type"];
                            var fileType = $(this).val().split('.').pop().toLowerCase();
                            //alert(fileType);
                            var validImageTypes = ["gif", "jpeg", "jpg", "png"];
                            if ($.inArray(fileType, validImageTypes) < 0) {
                                imageSection.addClass('err-input');
                                var errMsgSec = imageSection.children('label').children('.err-msg');
                                errMsgSec.removeClass('hide');
                                errMsgSec.html("*Invalid Image Format.");           
                            }
                            //console.log("Image file selected");
                            imageUploadCount++;

                        }
                    });

                    if(imageUploadCount == 0){
                        imageSection.addClass('err-input');
                        imageSection.children('label').children('.err-msg').removeClass('hide');
                        error = true;
                        //console.log("image count 0 ==== "+error);
                        //return false;                     
                        //e.preventDefault();
                    }
                    //console.log("Step "+i+" = "+imageUploadCount);

                    //validating audio file
                    var aduioSection = fileSection.children('.audio-section');
                    $(aduioSection).children('div .inline-flex').children('input').each(function(){
                        if ($(this).get(0).files.length === 0) {
                            //console.log("No audio files selected.");
                            aduioSection.addClass('err-input');
                            aduioSection.children('label').children('.err-msg').removeClass('hide');
                            error = true;
                            //console.log("audio count 0 ==== "+error);
                            //return false;
                            //e.preventDefault();
                        }else{
                            var file = $(this).get(0).files;
                            //var fileType = file["type"];
                            var fileType = $(this).val().split('.').pop().toLowerCase();
                            //alert(fileType);
                            var validImageTypes = ["wav", "mp3", "acc", "wma", "ogg", "midi","mpga"];
                            if ($.inArray(fileType, validImageTypes) < 0) {
                                aduioSection.addClass('err-input');
                                var errMsgSec = aduioSection.children('label').children('.err-msg');
                                errMsgSec.removeClass('hide');
                                errMsgSec.html("*Invalid Audio Format.");
                                error = true;
                                //console.log("audio invalid formate  ==== "+error);
                                //return false;    
                                //e.preventDefault();                        
                            }
                            //console.log("audio file selected");
                        }
                    });
                }else{
                    //console.log("Not selected = "+ i);
                }
            });
            //console.log(error);

	
            // Serialize the form data and redirect using ajax
            if(error==false){
                var fileData = new FormData($("#lesson-form")[0]);
                $.ajax({
                    url: '{{url('courses/insert')}}',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: fileData,
                    beforeSend: function() {
                        savBtn.html('Adding....');
                    },
                    error: function(data) {
                        savBtn.html('Add Course');
                        console.log("This is error section");
                    },
                    success: function(data){
                        console.log(data+" Added successfully");
                        location.href = '{{url('/courses')}}';                
                    }
                });
            }
            
        });

        

    });

  </script>





@endsection
