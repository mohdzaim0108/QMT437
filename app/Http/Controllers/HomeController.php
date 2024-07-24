<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\Difficulty;
use App\Models\Topic;
use App\Models\Formula;
use App\Models\Question;
use App\Models\QuestionStep;
use App\Models\QuestionResponse;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function lecturerData()
    {
        // Count the total number of questions in the Question table
        $totalQuestions = Question::count();
        $totalStudents = Student::count();
        $totalResponses = QuestionResponse::count();

        // Pass the count to the view
        return view('lecturer', compact('totalQuestions','totalStudents','totalResponses'));
    }
    public function studentData()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch the student record based on the user's ID
        $student = Student::where('userId', $userId)->first();

        // Check if the student record is found
        if ($student) {
            $studentId = $student->studentId;

            // Count the total number of responses for the specific studentId
            $totalResponses = QuestionResponse::where('studentId', $studentId)->count();
        } else {
            // Handle the case where no student record is found
            $totalResponses = 0;
        }

        // Count the total number of questions and students
        $totalQuestions = Question::count();
        $totalStudents = Student::count();

        // Pass the counts to the view
        return view('student', compact('totalQuestions', 'totalStudents', 'totalResponses'));
    }
    
}
    
