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

                    <div class="table-container">

                        
                        <form class="add-edit-lesson" name="add-edit-lesson" method="POST" action="{{url('course/insert')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Course Name</label>
                                <div class="col-sm-6">
                                    <input name="lesson_name" id="lesson_name" placeholder="Enter the course name" type="text" class="form-control">
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

                            <div class="position-relative row form-group step-section">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    <input class="step-switch" type="checkbox" name="course_step{{$i}}" value="1" id="step1" @if($i==1){{'checked'}} @endif/>
                                    Step {{$i}}:
                                </label>
                                <div class="col-sm-6 file-section @if($i!=1) {{'disable'}} @endif">
                                    <div class="image-section">
                                        <label>Image Files:</label>
                                        <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                        <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                        <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                        <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                        <input name="step{{$i}}_image[]" id="lesson_image{{$i}}" type="file" class="form-control-file file-choose">
                                    </div>
                                    <div class="audio-section">
                                        <label>Audio File:</label>
                                        <input name="step{{$i}}_audio" id="course_audio" type="file" class="form-control-file file-choose">
                                    </div>
                                    
                                    
                                </div>
                               
                            </div>

                            <?php } ?>
                            <?/*
                            <div class="position-relative row form-group step-section">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    <input class="step-switch" type="checkbox" name="course_step2" value="1" id="step1" />
                                    Step 2:
                                </label>
                                <div class="col-sm-6 file-section disable">
                                    <div class="image-section">
                                        <label>Image Files:</label>
                                        <input name="step2_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step2_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step2_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step2_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step2_image[]" id="lesson_image" type="file" class="form-control-file">
                                    </div>
                                    <div class="audio-section">
                                        <label>Audio File:</label>
                                        <input name="step2_audio" id="course_audio" type="file" class="form-control-file">
                                    </div>
                                    
                                    
                                </div>
                               
                            </div>

                            <div class="position-relative row form-group step-section">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    <input class="step-switch" type="checkbox" name="course_step3" value="1" id="step1" />
                                    Step 3:
                                </label>
                                <div class="col-sm-6 file-section disable">
                                    <div class="image-section">
                                        <label>Image Files:</label>
                                        <input name="step3_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step3_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step3_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step3_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step3_image[]" id="lesson_image" type="file" class="form-control-file">
                                    </div>
                                    <div class="audio-section">
                                        <label>Audio File:</label>
                                        <input name="step3_audio" id="course_audio" type="file" class="form-control-file">
                                    </div>
                                    
                                    
                                </div>
                               
                            </div>

                            <div class="position-relative row form-group step-section">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    <input class="step-switch" type="checkbox" name="course_step4" value="1" id="step1" />
                                    Step 4:
                                </label>
                                <div class="col-sm-6 file-section disable">
                                    <div class="image-section">
                                        <label>Image Files:</label>
                                        <input name="step4_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step4_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step4_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step4_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step4_image[]" id="lesson_image" type="file" class="form-control-file">
                                    </div>
                                    <div class="audio-section">
                                        <label>Audio File:</label>
                                        <input name="step4_audio" id="course_audio" type="file" class="form-control-file">
                                    </div>
                                    
                                    
                                </div>
                               
                            </div>

                            <div class="position-relative row form-group step-section">
                                
                                <label for="exampleSelect" class="col-sm-2 col-form-label">
                                    <input class="step-switch" type="checkbox" name="course_step5" value="1" id="step1" />
                                    Step 5:
                                </label>
                                <div class="col-sm-6 file-section disable">
                                    <div class="image-section">
                                        <label>Image Files:</label>
                                        <input name="step5_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step5_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step5_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step5_image[]" id="lesson_image" type="file" class="form-control-file">
                                        <input name="step5_image[]" id="lesson_image" type="file" class="form-control-file">
                                    </div>
                                    <div class="audio-section">
                                        <label>Audio File:</label>
                                        <input name="step5_audio" id="course_audio" type="file" class="form-control-file">
                                    </div>
                                    
                                    
                                </div>
                               
                            </div>
                            */?>


                            
                            
                            
                            
                            <div class="d-block text-center card-footer">
                        
                                <button class="btn-wide btn btn-success" id="saveLessonBtn" type="submit">Add Course</button>
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

        



  //});

  </script>





@endsection
