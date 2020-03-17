@extends('layouts.user-layout')

@section('mainSection')




<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/home")}}'>Home</a></li>
          <li class="breadcrumb-item"><a href='{{url("/tests")}}'>Tests</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Test</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>Add Test</h5>

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
                            <div class="alert alert-danger" style="display:none">sfas</div>
                            <label class="err-msg"></label>

                            
                            <form class="add-edit-lesson" id="lesson-form" name="add-edit-lesson" enctype="multipart/form-data">
                                @csrf

                                <div class="position-relative row form-group">
                                    <label for="test_name" class="col-sm-2 col-form-label">Test Name</label>
                                    <div class="col-sm-6">
                                        
                                        <input name="test_name" id="test_name" placeholder="Enter the test name" type="text" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="exampleSelect" class="col-sm-2 col-form-label">Choose Course</label>
                                    <div class="col-sm-6">
                                        <select name="lesson_category" id="exampleSelect" class="form-control">
                                            @isset($lessonRows)
                                                @foreach($lessonRows as $lesRow)
                                                    <option value="{{$lesRow->id}}" >{{$lesRow->name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <?/*
                                <div class="position-relative row form-group">
                                    <label for="exampleEmail" class="col-sm-2 col-form-label">Add Image</label>
                                    <div class="col-sm-6 dis-flex">
                                        <div class="col-sm-2">
                                            <label class="form-check-label">
                                                <input name="add_image" id="add_image_yes" type="radio" class="form-check-input" value="1" checked> Yes
                                            </label>    
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="form-check-label">
                                                <input name="add_image" id="add_image_no" type="radio" class="form-check-input" value="0"> No
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                                */?>
                                <div class="position-relative row form-group img-cnt">
                                    <label for="test_image" class="col-sm-2 col-form-label">Image File</label>
                                    <div class="col-sm-6 inline-flex" id="image_sec">
                                        <input name="test_image" id="test_image" type="file" class="form-control-file file_upload">                                        
                                        <span class="hide">
                                            <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-file">
                                                <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                            </button>
                                        </span>
                                        
                                    </div>
                                 </div>
                                 <div class="position-relative row form-group">
                                    <label for="test_audio" class="col-sm-2 col-form-label">Audio File</label>
                                    <div class="col-sm-6 inline-flex" id="audio_sec">
                                        <input name="test_audio" id="test_audio" type="file" class="form-control-file file_upload">                                        
                                        <span class="hide">
                                            <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-file">
                                                <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                            </button>
                                        </span>
                                        
                                    </div>
                                 </div>
                                 <div class="position-relative row form-group">
                                    <label for="test_name" class="col-sm-2 col-form-label">Options</label>
                                    <div class="col-sm-6">
                                        <div class="opt-conatiner">
                                            <div class="opt-block ">
                                                <div class="inline-flex">
                                                    <input name="test_option[]" id="test_option" placeholder="Enter the option" type="text" class="form-control opt-name" value="">
                                                
                                                </div>
                                                <span class="">
                                                    <label for="correct_option">
                                                        <input name="correct_option1" type="checkbox" class="form-check-input crt-opt" checked>
                                                        Mark as right option
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="opt-block ">
                                                <div class="inline-flex">
                                                    <input name="test_option[]" id="test_option" placeholder="Enter the option" type="text" class="form-control opt-name" value="">
                                                
                                                </div>
                                                <span class="">
                                                    <label for="correct_option">
                                                        <input name="correct_option2" type="checkbox" class="form-check-input crt-opt">
                                                        Mark as right option
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="opt-block ">
                                                <div class="inline-flex">
                                                    <input name="test_option[]" id="test_option" placeholder="Enter the option" type="text" class="form-control opt-name" value="">
                                                
                                                </div>
                                                <span class="">
                                                    <label for="correct_option">
                                                        <input name="correct_option3" type="checkbox" class="form-check-input crt-opt">
                                                        Mark as right option
                                                    </label>
                                                </span>
                                            </div>
                                             
                                        </div>
                                        <div class="add-more-option-field">
                                            <button type="button" class="mr-2 btn btn-outline-primary btn-sm add-more-option">+Add More</button>

                                        </div>
                                    </div>
                                </div>
                                
                                
                                

                                

                            
                            </form>

                        </div>
                        
                        <div class="d-block text-center card-footer">
                            <button class="btn-wide btn btn-success" id="saveTestBtn">Add Test</button>
                        </div>
                                    
                   

                  </div>

                </div>
            </div>

        </div>

    </div>
    <!-- @include('includes/footer') -->
  </div>

  <script>
  
    $('.add-more-option').click(function(){
        console.log("add option");
        var opt_container = $('.opt-conatiner');
        
        var count = 1;
        $('.opt-block ').each(function(){
            count++;
        });
        var toAdd = '<div class="opt-block "><div class="inline-flex"><input name="test_option[]" id="test_option" placeholder="Enter the option" type="text" class="form-control opt-name" value=""></div><span class=""><label for="correct_option">&nbsp;<input name="correct_option'+count+'" type="checkbox" class="form-check-input crt-opt">Mark as right option</label></span></div>';
        if(count<6){
            opt_container.append(toAdd);
        }else{
            alert("Sorry. You cannot add more than 5 options.");
        }
        

    });   

        
    $(document).ready(function(){

        //make checkbox working as radio button.
        $(document).on("change", ".crt-opt", function() {    
            $(".crt-opt").prop('checked', false);
            $(this).prop('checked', true);
        });

        //disable and enable upload image
        $('input[type=radio][name=add_image]').change(function () {
            var img = $('.img-cnt');
            var value = $(this).val();
            //alert(value);
            if (value == 1) {
                img.slideDown(400);
            }
            if (value == 0) {
                img.slideUp(400);
                $('#image_sec').removeClass('err-input');
            }
            
        });
    

       

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


        //$(document).on("click", $('#saveTestBtn'), function(e){
        $('#saveTestBtn').click(function(){
            var savBtn = $(this);
            var name = $('#test_name');
            var errField = $('.err-msg');
            errField.html('');
            name.removeClass('err-input');
            $('#image_sec').removeClass('err-input');
            $('#audio_sec').removeClass('err-input');
            $(".opt-name").each(function(){
                $(this).removeClass('err-input');
            });

            //get image from input field
            var imageVal = $("#test_image");
            var imgLength = imageVal.get(0).files.length;
            var imgFileType = imageVal.val().split('.').pop().toLowerCase();
            var validImageTypes = ["gif", "jpeg", "jpg", "png"];
            //get audio from input field
            var audioVal = $("#test_audio");
            var audioLength = audioVal.get(0).files.length;
            var audioFileType = audioVal.val().split('.').pop().toLowerCase();
            var validAudioTypes = ["wav", "mp3", "acc", "wma", "ogg", "midi","mpga"];

            //check option value is entered or not
            var optCount = 0;
            $(".opt-name").each(function(){
                if($(this).val()!=""){
                    optCount++;
                }
            });


            if(name.val()==''){
                name.addClass('err-input');
                errField.html('*Please enter test name.');
                $('html, body').animate({
                    scrollTop: $(".card-header").offset().top
                }, 600);
                        
            }else if(($("#add_image_yes").is(":checked")) && (imgLength === 0)){
                    $('#image_sec').addClass('err-input');
                    errField.html('*Please choose test image file.');
            }
            else if(($("#add_image_yes").is(":checked")) && ($.inArray(imgFileType, validImageTypes) < 0)){
                        $('#image_sec').addClass('err-input');
                        errField.html('*Please choose valid test image file.');
            }else if(audioLength === 0) {
                $('#audio_sec').addClass('err-input');
                errField.html('*Please choose test audio file.');
            }else if((audioLength > 0) && ($.inArray(audioFileType, validAudioTypes) < 0) ) {
                $('#audio_sec').addClass('err-input');
                errField.html('*Please choose valid test audio file.');
            }else if(optCount==0){
                $(".opt-name").each(function(){
                    console.log("test Option")
                    $(this).addClass('err-input');
                });
                errField.html('*Please enter the options.');
            }else{
                var fileData = new FormData($("#lesson-form")[0]);
                $.ajax({
                    url: '{{url('tests/insert')}}',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: fileData,
                    beforeSend: function() {
                        savBtn.html('Adding....');
                    },
                    error: function(data) {
                        savBtn.html('Add Test');
                        console.log("This is error section");
                    },
                    success: function(data){
                        console.log(data+" Added successfully");
                        location.href = '{{url('/tests')}}';                
                    }
                });
            }
            
            
        });

        

    });

  </script>





@endsection
