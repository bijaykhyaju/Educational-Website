@extends('layouts.user-layout')

@section('mainSection')


<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="/lessons">Courses</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Course</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>Add Lesson</h5>

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
                                        <input name="course_name" id="course_name" placeholder="Enter the course name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="position-relative row form-group"><label for="exampleSelect" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-6">
                                        <select name="lesson_category" id="exampleSelect" class="form-control">
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
                                
                                <?php 

                                for($i = 1 ; $i <= 5 ; $i++){


                                ?>

                                <div class="position-relative row form-group step-section" @if($i>2) {{"style=display:none;"}} @endif>
                                    
                                    <label for="step{{$i}}" class="col-sm-2 col-form-label">
                                        <input class="step-switch" type="checkbox" name="course_step{{$i}}" value="1" id="step{{$i}}" @if($i ==1) {{'checked'}} @endif/>
                                        Step {{$i}}:
                                    </label>
                                    <div class="col-sm-6 file-section @if($i!=1) {{'disable'}} @endif">
                                        <div class="image-section">
                                            <label>Image Files:&nbsp;<span class="hide err-msg">*Choose image file.</span></label>
                                            <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                            <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                            <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                            <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                            <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                        </div>
                                        <div class="audio-section">
                                            <label>Audio File:&nbsp;<span class="hide err-msg">*Choose audio file.</span></label>
                                            <input name="step{{$i}}_audio" id="course_audio" type="file" class="form-control-file file-choose">
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
        $('#saveLessonBtn').click(function(){
            var name = $('#course_name');
            $('.err-msg').addClass('hide');
            name.removeClass('err-input');
            $('.image-section').each(function(){
                $(this).removeClass('err-input');
            });
            $('.audio-section').each(function(){
                $(this).removeClass('err-input');
            });
            // if(name.val()==''){
            //     name.addClass('err-input');
            //     $('html, body').animate({
            //         scrollTop: $(".card-header").offset().top
            //     }, 600);   
            //     return;
                
            // }
            // var i = 1;
            // $('.step-switch').each(function(){
            //     var t = $(this);

            //     if( t.prop('checked') == true ) {
            //         //console.log("Selected = "+ i);

            //         //image validation
            //         var fileSection = t.parent().next('div .file-section');
            //         var imageSection = fileSection.children('.image-section');
            //         //console.log($(imageSection).attr('class'));
            //         var imageUploadCount = 0;
            //         $(imageSection).children('input').each(function(){
            //             if ($(this).get(0).files.length === 0) {
            //                 console.log("No image files selected.");

            //             }else{
            //                 var file = $(this).get(0).files;
            //                 //var fileType = file["type"];
            //                 var fileType = $(this).val().split('.').pop().toLowerCase();
            //                 //alert(fileType);
            //                 var validImageTypes = ["gif", "jpeg", "jpg", "png"];
            //                 if ($.inArray(fileType, validImageTypes) < 0) {
            //                     imageSection.addClass('err-input');
            //                     var errMsgSec = imageSection.children('label').children('.err-msg');
            //                     errMsgSec.removeClass('hide');
            //                     errMsgSec.html("*Invalid Image Format.")
                                 
            //                 }
            //                 console.log("Image file selected");
            //                 imageUploadCount++;

            //             }
            //         });

            //         if(imageUploadCount == 0){
            //             imageSection.addClass('err-input');
            //             imageSection.children('label').children('.err-msg').removeClass('hide');
            //             return;
                        
            //         }
            //         //console.log("Step "+i+" = "+imageUploadCount);

            //         //validating audio file
            //         var aduioSection = fileSection.children('.audio-section');
            //         $(aduioSection).children('input').each(function(){
            //             if ($(this).get(0).files.length === 0) {
            //                 console.log("No audio files selected.");
            //                 aduioSection.addClass('err-input');
            //                 aduioSection.children('label').children('.err-msg').removeClass('hide');
            //                 return;

            //             }else{
            //                 var file = $(this).get(0).files;
            //                 //var fileType = file["type"];
            //                 var fileType = $(this).val().split('.').pop().toLowerCase();
            //                 //alert(fileType);
            //                 var validImageTypes = ["wav", "mp3", "acc", "wma", "ogg", "midi"];
            //                 if ($.inArray(fileType, validImageTypes) < 0) {
            //                     aduioSection.addClass('err-input');
            //                     var errMsgSec = aduioSection.children('label').children('.err-msg');
            //                     errMsgSec.removeClass('hide');
            //                     errMsgSec.html("*Invalid Audio Format.");
            //                     return;
                                
            //                 }
            //                 console.log("audio file selected");
                            

            //             }
            //         });

                    

            //     }else{
            //         //console.log("Not selected = "+ i);
            //     }


            //     i++;
            // });
           
            //$form = $(event.target);
	
            // Serialize the form data
           // var formData = $form.serialize();
            //var formData = new FormData($('#lesson-form')[0])
           // var formData = jQuery('#lesson-form').serialize();// new FormData(jQuery('#lesson-form')[1]);
            // var fileUpload = $("#lesson-form").get(0);//files;
            // var files = fileUpload.files;
            // var fileData= new FormData();
            var fileData = new FormData($("#lesson-form")[0]);
            //console.log(fileData)
            $.ajax({
                url: '{{url('course/insert')}}',
                type: 'post',
                processData: false,
                contentType: false,
                data: fileData,//$("#lesson-form").serialize(),
                error: function(data) {
                    console.log("This is error section"+ data);
                    
                    
                    
                },
                success: function(data){
                    console.log(data);
                    jQuery.each(data.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>'+value+'</p>');
                    });
                }
            });
            return;
        });
        

    });

  </script>





@endsection
