@extends('layouts.user-layout')

@section('mainSection')
<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/home")}}'>Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tests</li>
        </ol>
      </nav>

        <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">

                          <div class="top-bar">
                              <div class="left-element">
                                <h3>List of Tests</h3>
                              </div>

                              <div class="right-element ">
                                <a href="{{url('/tests/add')}}"><button type="button" class="btn btn-info" id="add-test">Add Test</button></a>
                              </div>
                          </div>

                            <table class="mb-0 table">
                                <thead>
                                <tr>
                                    <th class="card-title">S.N</th>
                                    <th class="card-title" colspan="6">Test Name</th>
                                    <th class="card-title">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                
                                @if($testCount>0)
                                  @foreach($tests as $index => $test)

                                  <tr>
                                      <th scope="row">{{ ++$index }}</th>
                                      <td colspan="6"><a href="/course/edit/{{$test->id}}" style="text-decoration:none;">{{$test->name}}</a></td>
                                      <td>

                                        <button class="btn btn-danger btn-sm delete-course" data-toggle="modal" data-target="#deleteLessonModal" rel="{{$test->id}}">Delete</button>
                                      </td>
                                  </tr>

                                  @endforeach

                                @else
                                
                                ?>
                                  <tr>
                                      <td colspan="8">No tests found. Click "Add Test" button to create.</td>
                                  </tr>
                                  @endif

                                <!-- Modal -->
                                <div class="modal fade" id="deleteTestModal" tabindex="-1" role="dialog" aria-labelledby="deleteTestModal" aria-hidden="true" data-backdrop="false">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this test?</h5>

                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <p class="err-msg">This will delete the whole test including steps, test and files. Are you sure you want to continue?</p>

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
                                <input name="test_id" id="test_id_delete" value="" hidden>
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
    location.href = '/course/'+musicId;
  });

  $('.delete-course').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#test_id_delete').val(id);

  });



  $('#deleteBtn').click(function(){
        var mId = $('#test_id_delete').val();
        //alert(mId);
        var delBtn = $(this);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(CSRF_TOKEN);
        $.ajax({
          url: '/course/delete',
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
