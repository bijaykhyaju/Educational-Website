<?php

namespace App\Http\Controllers;

use App\Test;
use App\Lesson;
use App\TestOption;
use App\TestFile;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tests = Test::latest()->get();
        $testCount = Test::count();
        return view('manage_test', compact(['tests', 'testCount']));
    }

    public function addEditTestPage(){
        $lessonRows = Lesson::where('publish',1)
                        ->latest()
                        ->get();
        
        return view ('add-edit-test',compact(['lessonRows']));

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
        //
        $name = $request->test_name;
        $test_type = $request->test_type;
        $image_file = $request->test_image;
        $audio_file = $request->test_audio;
        
        $test = new Test();
        $test->name = $name;
        $test->lesson_id = $test_type;
        $test->save();

        //get id of recently added test
        $testId = $test->id;
        
        $options = data_get($request, "test_option");
        // var_dump($options);
        // dd();
        if($options){
            //$i = 1;
            foreach($options as $key => $value){
                $i=$key+1;
                $option_step = "correct_option".$i;
                $optionRight = $request->has($option_step) ? 1 : 0;
                
                //echo $request->input($option_step);
                $test_option = new TestOption();
                $test_option->name = $value;
                $test_option->test_id = $testId;
                $test_option->right_option = $optionRight;
                $test_option->save();
                
            }
            
        }
        if($image_file){
            $dateTime = date('Y-m-d-H-i-s')."-".uniqid();
            $extn = $image_file->getClientOriginalExtension();
            $fileName =$dateTime.".".$extn;
            //$fileName = time()."_".$fn;//.'.'.$image->extension(); //for image extension

            //echo $fileName."\n";
            //dd();
            if(Storage::putFileAs('uploads/test/images', new File($image_file), $fileName)){
                $test_file = new TestFile();
                $test_file->test_id = $testId;
                $test_file->type = '1';
                $test_file->file = $fileName;
                $test_file->order = '1';
                $test_file->save();
            }else{
                echo "Error uploading image files";
                dd();
            }
        }
        if($audio_file){
            $dateTime = date('Y-m-d-H-i-s')."-".uniqid();
            $audio_extn = $audio_file->getClientOriginalExtension();
            $audioFileName =$dateTime.".".$audio_extn;
            //$fileName = time()."_".$fn;//.'.'.$image->extension(); //for image extension

            //echo $fileName."\n";
            //dd();
            if(Storage::putFileAs('uploads/test/audio', new File($audio_file), $audioFileName)){
                $test_file = new TestFile();
                $test_file->test_id = $testId;
                $test_file->type = '2';
                $test_file->file = $audioFileName;
                $test_file->order = '1';
                $test_file->save();
            }else{
                echo "Error uploading audio files";
                dd();
            }
        }
        

        return $this->index();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
