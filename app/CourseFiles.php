<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseFiles extends Model
{
    //
    public static function getCourseImagesByCourseId($id){
        $fileRows = CourseFiles::where('course_id', $id)
                        ->where('image','1')
                        ->get();
        return $fileRows;
    }

    public static function getCourseAudioByCourseId($id){
        $fileRows = CourseFiles::where('course_id', $id)
                        ->where('audio','1')
                        ->get();
        return $fileRows;
    }

}
