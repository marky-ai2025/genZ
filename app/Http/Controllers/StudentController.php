<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class StudentController extends Controller
{

    public function getStudents(){
        $student = Student::all();

        return response()->json($student);
    }
   
    public function index()
    {
        return view('admin.studentinformation');
    }

   
    public function create()
    {
   
    }

 
    public function store(Request $request)
    {


        
        $validatedData = $request->validate([
        
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'address' => 'required|string|max:500',
            'school' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'civilstatus' => 'required|string|max:255',
            'religion' => 'nullable|string|max:255',
        ]);
    
        $student = Student::create($validatedData);
    
        return response()->json([
            'message' => 'Student added successfully!',
            'student' => $student
        ], 201);
    }

   
    public function show(string $id)
    {
        //
    }

    
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }
    

    
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
    
        return response()->json(['message' => 'Student updated successfully!']);
    }
    
    

  
    public function destroy(string $id)
    {
        $student = Student::find($id);
    
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
    
        $student->delete();
    
        return response()->json(['message' => 'Student deleted successfully!']);
    }

    public function getSchoolCounts()
    {
        $schoolCounts = Student::selectRaw('school, COUNT(*) as count')
            ->groupBy('school')
            ->pluck('count', 'school');

        return response()->json($schoolCounts);
    }
    


    
}