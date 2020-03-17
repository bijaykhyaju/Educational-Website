<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //check the course of the lesson
    public static function getCourseByLessonIdAndCourseName($lesId, $courseName){

        $isSelected = Course::where('name', $courseName)
                        ->where('lesson_id', $lesId)
                        ->first();
        return $isSelected;

    }
    public static function getCourseByLessonId($lesId){

        $courseRows = Course::where('lesson_id', $lesId)
                        ->get();
        return $courseRows;

    }
}
