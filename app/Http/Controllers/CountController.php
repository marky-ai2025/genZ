<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Student; 
use Illuminate\Support\Facades\Response;

class CountController extends Controller
{

  
    
    public function countStudents()
    {
        $studentCount = Student::count(); 
        return response()->json(['studentCount' => $studentCount]); 
    }

    public function countByProgram()
    {
        $interns = Student::where('program', 'Internship')->count();
        $immersion = Student::where('program', 'Immersion')->count();
        $affiliates = Student::where('program', 'Affiliates')->count();

        return response()->json([
            'interns' => $interns,
            'immersion' => $immersion,
            'affiliates' => $affiliates
        ]);
    }

    public function countByGender()
    {
        $maleCount = Student::where('gender', 'Male')->count();
        $femaleCount = Student::where('gender', 'Female')->count();

        return response()->json([
            'male' => $maleCount,
            'female' => $femaleCount
        ]);
    }

    public function countStudentsByCourse(): JsonResponse
    {
        $courses = Student::select('course')
            ->groupBy('course')
            ->selectRaw('course, COUNT(*) as count')
            ->get();

        return response()->json($courses);
    }
    public function getStudentBySchools()
    {
        $schools = Student::select('school')
            ->groupBy('school')
            ->selectRaw('school, COUNT(*) as student_count')
            ->pluck('student_count', 'school');

        return response()->json($schools);
    }


  
}
