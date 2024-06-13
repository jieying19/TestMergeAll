<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentRegistrationController extends Controller
{
    /**
     * Display a listing of student registration info.
     */
    public function index()
    {
        $students = Student::all();
       
        return view('ManageStudentRegistration.StudentRegistrationList',compact('students'));
    }

    /**
     * Show the form for adding a new student registration.
     */
    public function create()
    {
        return view('ManageStudentRegistration.AddStudentRegistrationForm');
    }

    /**
     * Store a newly added student registration.
     */
    public function store(Request $request)
    {

        $existingProduct = Student ::where('student_id', $request->student_id)->first();

        if ($existingProduct != null) {
            return redirect()->route('ManageStudentRegistration.AddStudentRegistrationForm')->with('error', 'Student registration details already exists.');
        }

        $student = new Student();
        Student::orderby('student_id')->get();
        $student->student_name = $request->student_name;
        $student->student_age = $request->student_age;
        $student->student_gender = $request->student_gender;
        $student->student_birthRegNo = $request->student_birthRegNo;
        $student->student_ic = $request->student_ic;
        $student->student_health = $request->student_health;
        $student->student_birthPlace = $request->student_birthPlace;
        $student->student_homeAddress = $request->student_homeAddress;

      
        $student->save();
        return redirect()->route('ManageStudentRegistration.StudentRegistrationList')->with('success', 'Student registration info added successfully');
    }

    /**
     * Display the specified student registration details.
     */
    public function show($student_id)
    {
        $student = Student::find($student_id);
        return view('ManageStudentRegistration.ViewStudentRegistrationForm', compact('student'));
    }

    /**
     * Show the form for editing the specified student registration details.
     */
    public function edit($student_id)
    {
        $student = Student::find($student_id);
        return view('ManageStudentRegistration.EditStudentRegistrationForm', compact('student'));
    }
    

    /**
     * Update the specified student registration in databse.
     */
    public function update(Request $request, Student $student)
    {
        $student = Student::find($request->student_id);
        $student->student_name = $request->student_name;
        $student->student_age = $request->student_age;
        $student->student_gender = $request->student_gender;
        $student->student_birthRegNo = $request->student_birthRegNo;
        $student->student_ic = $request->student_ic;
        $student->student_health = $request->student_health;
        $student->student_birthPlace = $request->student_birthPlace;
        $student->student_homeAddress = $request->student_homeAddress;
      
        $student->save();
        return redirect()->route('ManageStudentRegistration.StudentRegistrationList')->with('success', 'Student registration updated successfully');
    }

    public function updateStatus(Request $request, $student_id)
{
    // Validate the request data
    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    // Find the student by ID
    $student = Student::find($student_id);

    // Update the student's status based on the action
    $student->student_regStatus = $request->status;
    $student->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Student status updated successfully');
}




    /**
     * Remove the specified student registration details from database.
     */
    public function destroy($student_id)
    {
        $student = Student::find($student_id);
        $student->delete();
        return redirect()->route('ManageStudentRegistration.StudentRegistrationList')->with('success', 'Student Registration deleted successfully');
    }

   


    public function indexStudentReport(Request $request)
    {
        $currentDate = Carbon::now()->format('l, d F Y');

        $students = Student::whereBetween('student_age', [6, 12])->get();

        if ($request['range'] == 'weekly' || $request['range'] == 'monthly' || $request['range'] == 'yearly') {
            $range = $request['range'];
        } else {
            $range = 'weekly';
        }

        return view('ManageStudentRegistration.ViewStudentRegistrationReport')->with([
            'currentDate' => $currentDate,
            'students' => $students,
            'range' => $range,
        ]);
    }

    public function exportStudentCSV()
    {
        $students = Student::whereBetween('student_age', [6, 12])->get();

        // Create a temporary file path
        $tempFilePath = 'D:/Student_Registration_Data.csv';

        // Open the temporary file in write mode
        $file = fopen($tempFilePath, 'w');

        // Write the fields to the temporary file
        fputcsv($file, ['Student ID', 'Name', 'Age', 'Gender', 'Birth Reg No', 'IC', 'Health Condition', 'Birth Place', 'Home Address']);

        // Iterate through the data and write it to the temporary file
        foreach ($students as $student) {

             // Format IC number as text
             $icNumber = "'" . $student->student_ic;

            fputcsv($file, [

                $student->student_id,
                $student->student_name,
                $student->student_age,
                $student->student_gender,
                $student->student_birthRegNo,
                $icNumber,
                $student->student_health,
                $student->student_birthPlace,
                $student->student_homeAddress,
            ]);
        }

        // Close the file
        fclose($file);

        // Create the response with the file contents
        $response = Response::make(file_get_contents($tempFilePath));

        // Set headers to force download
        $response->header('Content-Type', 'application/csv');
        $response->header('Content-Disposition', 'attachment; filename="Student_Registration_Data.csv"');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        // Delete the temporary file
        unlink($tempFilePath);

        return $response;
    }



    public function getAgeData($range)
    {
        $ageData = [];

        switch ($range) {
            case 'weekly':
                $ageGroups = collect([
                    ['age' => '6', 'count' => 0],
                    ['age' => '7', 'count' => 0],
                    ['age' => '8', 'count' => 0],
                    ['age' => '9', 'count' => 0],
                    ['age' => '10', 'count' => 0],
                    ['age' => '11', 'count' => 0],
                    ['age' => '12', 'count' => 0],
                ]);

                foreach ($ageGroups as $ageGroup) {
                    $count = Student::where('student_age', $ageGroup['age'])->count();
                    $ageData[] = ['age' => $ageGroup['age'], 'count' => $count];
                }
                break;

            // Add cases for 'monthly' and 'yearly' if needed

            default:
                return response()->json(['error' => 'Invalid range']);
        }

        return response()->json($ageData);
    }
}