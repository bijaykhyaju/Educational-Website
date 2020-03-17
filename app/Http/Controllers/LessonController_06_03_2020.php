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

    public function addPage()
    {
        //
        $catRows = Category::getAllCategories();
        //dd($catRows);
        return view('add-edit-lesson',compact('catRows'));

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
        // if ($validator->fails())
        // {
        //     return response()->json(['errors'=>$validator->errors()->all()]);
        // }

        //run the query to all new course.
        $lesson = new Lesson();
        $lesson->name = $name;
        $lesson->category = $category;
        $lesson->prerequisite = $pre_req;
        $lesson->order = '1';
        $lesson->publish = '1';
        $lesson->save();

        // $request->validate([
        //     'name' => 'required|mimes:pdf,xlx,csv|max:2048',
        // ]);
        
        
        //get id of recently added lesson
        $lessonId = $lesson->id;
        //return $lessonId;
        
        $stepArray = array('course_step1', 'course_step2', 'course_step3', 'course_step4', 'course_step5');
        
        for($i=0; $i < count($stepArray); $i++){
            $j = $i+1;

            if($request->input($stepArray[$i])==$j){

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
                $images = $request->step1_image;
                foreach($images as $image){
                    $fn = $image->getClientOriginalName();
                    $fileName = time()."_".$fn;//.'.'.$image->extension(); //for image extension
                    //return $fileName;
                    

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

                //add audio file
                $audio = $request->step1_audio;
                if($audio){
                    $adio_fn = $audio->getClientOriginalName();
                    $audioFileName = time()."_".$adio_fn;
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
    public function destroy(Lesson $lesson)
    {
        //
    }
}
