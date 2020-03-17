<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Category;
use App\CourseFiles;
use App\Course;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Load list of lesson page
     */
    public function index()
    {
        //

        $lessons = Lesson::latest()->get();
        $lessonCount = Lesson::count();
        //echo $lessonCount;
        //return;
        return view('lessons', compact(['lessons','lessonCount']));

    }

    /**
     * Load add lesson page
     */

    public function addEditPage(Request $request)
    {
        //
        $catRows = Category::getAllCategories();
        //dd($catRows);
        $action = "add";
        
        if($request->id){
            //return "Edit";
            $action = "edit";
            $lesson= Lesson::where("id",$request->id)->first();
            //return $lesson;
            return view('add-edit-lesson',compact(['catRows', 'action', 'lesson']));
        }
        return view('add-edit-lesson',compact(['catRows', 'action']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dumpp all the request from form
        //dump($request->all());
        //var_dump($request->step1_audio);
        //
        //return(uniqid());

        $name = $request->course_name;
        $category = $request->lesson_category;
        $prerequisite = $request->prereq;

        $preReqs = [];
        $pre_req = '';
        if($prerequisite){
            foreach($prerequisite as $preReq){
                $preReqs[] = $preReq;
            }
            $pre_req = implode(',', $preReqs);
        }
        //return $request->course_step1;
        $validator = \Validator::make($request->all(), [
            'course_name' => 'required|unique:posts|max:255',
        ]);
    
        //run the query to all new course.
        $lesson = new Lesson();
        $lesson->name = $name;
        $lesson->category = $category;
        $lesson->prerequisite = $pre_req;
        $lesson->order = '1';
        $lesson->publish = '1';
        $lesson->save();

      
        
        //get id of recently added lesson
        $lessonId = $lesson->id;
        //return $lessonId;
        
        $stepArray = array('course_step1', 'course_step2', 'course_step3', 'course_step4', 'course_step5');
        
        for($i=0; $i < count($stepArray); $i++){
            $j = $i+1;

            if($request->input($stepArray[$i])==1){

                //add in course table as steps of the lesson
                $course = new Course();
                $course->name = $stepArray[$i];//"Step 1";
                $course->lesson_id = $lessonId;
                $course->order = '1';
                $course->publish = '1';
                $course->save();
                
                //get id of recently added lesson
                $courseId = $course->id;
                $image_input_name = "step".$j."_image";

                //add images in database and upload in a folder
                //$images = $request->input($image_input_name);
                //$images = $request->step1_image;

                $images = data_get($request, $image_input_name);

                //dump($image_input_name."---->".$images);
                //dump($image_input_name."---->".$request->step1_image);
                if($images){
                    foreach($images as $image){
                        //$fn = $image->getClientOriginalName();

                        //get date and time
                        $dateTime = date('Y-m-d-H-i-s')."-".uniqid();
                        
                        $extn = $image->getClientOriginalExtension();
                        $fileName =$dateTime.".".$extn;
                        //$fileName = time()."_".$fn;//.'.'.$image->extension(); //for image extension

                        //echo $fileName."\n";
                        //dd();
                        if(Storage::putFileAs('uploads/images', new File($image), $fileName)){
                            $course_file = new CourseFiles();
                            $course_file->course_id = $courseId;
                            $course_file->image = '1';
                            $course_file->file = $fileName;
                            $course_file->order = '1';
                            $course_file->save();
                        }else{
                            echo "Error uploading image files";
                            dd();
                        }
                    }
                }
                

                //add audio file
                $audio_input_name = "step".$j."_audio";

                $audio = data_get($request, $audio_input_name);
                //$audio = $request->step1_audio;
                if($audio){
                    // $adio_fn = $audio->getClientOriginalName();
                    // $audioFileName = time()."_".$adio_fn;
                    
                    //get date and time
                    $audioDateTime = date('Y-m-d-H-i-s')."-".uniqid();
                    $aud_extn = $audio->getClientOriginalExtension();
                    //$rand_no = str_rand(5)->unique();
                    $audioFileName =$audioDateTime.".".$aud_extn;

                    //echo $audioFileName."\n";
                    if(Storage::putFileAs('uploads/audio', new File($audio), $audioFileName)){
                        $course_file = new CourseFiles();
                        $course_file->course_id = $courseId;
                        $course_file->audio = '1';
                        $course_file->file = $audioFileName;
                        $course_file->order = '1';
                        $course_file->save();
                    }else{
                        echo "Error uploading audio file";
                        dd();
                    }
                }
    
            }
        }
        return $this->index();
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $lessonId = $request->id;
        //return "music id = ".$musicId;

        //delete all the courses and course files
        $courseRows = Course::where('lesson_id',$lessonId)
                            ->get();
        //dd($courseRows);
        //return(storage_path());
        foreach($courseRows as $cRow){
            $courseFiles = CourseFiles::where('course_id',$cRow->id)
                                ->get();
            foreach($courseFiles as $fRow){
                if($fRow->image==1){
                    if(Storage::exists('uploads/images/' . $fRow->file)){
                        Storage::delete('uploads/images/' . $fRow->file);
                        //CourseFiles::where('course_id', $fRow->id )->delete();
                        //return $fRow->file." ====  Deleted";
                      }else{
                        //return "File Not Found or Deleted";
                      }
                }
                if($fRow->audio==1){
                    if(Storage::exists('uploads/audio/' . $fRow->file)){
                        Storage::delete('uploads/audio/' . $fRow->file);
                        //return $fRow->file." ====  Deleted";
                      }else{
                        //return "File Not Found or Deleted";
                      }
                }
                CourseFiles::where('id', $fRow->id )->delete();
            }
        }
        Course::where('lesson_id',$lessonId )->delete();
        Lesson::where('id',$lessonId )->delete();

    }
}
