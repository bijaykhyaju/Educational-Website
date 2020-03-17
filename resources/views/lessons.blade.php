@extends('layouts.user-layout')

@section('mainSection')
<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/home")}}'>Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Courses</li>
        </ol>
      </nav>

        <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">

                          <div class="top-bar">
                              <div class="left-element">
                                <h3>List of Courses</h3>
                              </div>

                              <div class="right-element ">
                                <a href="{{url('/courses/add')}}"><button type="button" class="btn btn-info" id="add-course">Add Course</button></a>
                              </div>
                          </div>

                            <table class="mb-0 table">
                                <thead>
                                <tr>
                                    <th class="card-title">S.N</th>
                                    <th class="card-title" colspan="6">Course Name</th>
                                    <th class="card-title">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $index = 0;?>
                                @if($lessonCount>0)
                                  @foreach($lessons as $index => $lesson)

                                  <tr>
                                      <th scope="row">{{ ++$index }}</th>
                                      <td colspan="6"><a href="/courses/edit/{{$lesson->id}}" style="text-decoration:none;">{{$lesson->name}}</a></td>
                                      <td>

                                        <button class="btn btn-danger btn-sm delete-course" data-toggle="modal" data-target="#deleteLessonModal" rel="{{$lesson->id}}">Delete</button>
                                      </td>
                                  </tr>

                                  @endforeach

                                @else
                                
                                
                                  <tr>
                                      <td colspan="8">No lessons found. Click "Add Course" button to create.</td>
                                  </tr>
                                  @endif

                                <!-- Modal -->
                                <div class="modal fade" id="deleteLessonModal" tabindex="-1" role="dialog" aria-labelledby="deleteLessonModal" aria-hidden="true" data-backdrop="false">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this lesson?</h5>

                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <p class="err-msg">This will delete the whole lesson including steps, test and files. Are you sure you want to continue?</p>

                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteBtn">Confirm</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                </tbody>
                                <input name="lesson_id" id="lesson_id_delete" value="" hidden>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
  $('#add-course').click(function(){
    location.href = '/course';

  });
  $('.edit-course').click(function(){
    var musicId = $(this).attr('rel');
    //alert(musicId);
    location.href = '/courses/'+musicId;
  });

  $('.delete-course').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#lesson_id_delete').val(id);

  });



  $('#deleteBtn').click(function(){
        var mId = $('#lesson_id_delete').val();
        //alert(mId);
        var delBtn = $(this);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(CSRF_TOKEN);
        $.ajax({
          url: '/courses/delete',
          type: 'post',
          data: { _token : CSRF_TOKEN, id: mId},
          beforeSend: function() {
              // setting a timeout
              //alert('hello');
              delBtn.html('Deleting');
          },
          error:function(data){
            delBtn.html('Confirm');
            console.log(data);
          },
          success: function(data){
            console.log(data+"Deleted");
            location.href = '{{url("/courses")}}';

          }


          });




  });


</script>



@endsection
