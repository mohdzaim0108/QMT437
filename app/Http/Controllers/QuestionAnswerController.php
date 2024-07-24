<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Http\Request;
use App\Models\Difficulty;
use App\Models\Topic;
use App\Models\Formula;
use App\Models\Question;
use App\Models\QuestionStep;
use App\Models\QuestionResponse;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class QuestionAnswerController extends Controller
{
    public function questionAnswer(Request $request, $questionId)
    {
        
        $questions = Question::findOrFail($questionId);
        $questionSteps = QuestionStep::where('questionId', $questionId)->get();
 

        return view('questionAnswer', compact('questions', 'questionSteps'));
        

    }

    public function checkAnswer(Request $request, $questionId, $questionStepId)
    {
        // Validate the input
        $request->validate([
            'answer' => 'required|numeric',
        ]);

        $submittedAnswer = $request->input('answer');

        // Retrieve the specific question step along with the associated formula
        $step = QuestionStep::where('questionId', $questionId)
            ->where('questionStepId', $questionStepId)
            ->with('formula')
            ->firstOrFail();

        $acceptableRange = 0.5;
        $correctAnswer = $step->answer;

        // Use absolute difference for numerical comparison
        $isCorrect = abs($submittedAnswer - $correctAnswer) <= $acceptableRange;

        // Convert boolean to integer (0 or 1)
        $isAnswerTrue = $isCorrect ? 1 : 0;

        // Get the formula name
        $formulaName = $step->formula->formula;

        // Construct the message
        $message = $isCorrect ? "Correct answer! By find or using $formulaName , you can solve this step!" : "Incorrect answer, please try again by find or using formula $formulaName.";

        // Get the student ID
        $studentId = Student::where('userId', auth()->id())->value('studentId');

        // Check if it's the student's first time answering this question step
        $existingResponse = QuestionResponse::where('questionStepId', $questionStepId)
            ->where('studentId', $studentId)
            ->first();
       
        if (!$existingResponse) 
        {
            $response = new QuestionResponse;
            $response->questionStepId = $questionStepId;
            $response->studentId = $studentId;
            $response->isAnswerTrue = $isAnswerTrue;
            $response->save();
        }

        $userAnswers = Session::get('userAnswers', []);
        $userAnswers[$questionStepId] = $request->input('answer');
        Session::put('userAnswers', $userAnswers);
        
        return response()->json([
            'success' => $isCorrect,
            'message' => $message,
        ]);
    }
    public function summaryAnswer($questionId)
    {
        $question = Question::find($questionId);
        $questionSteps = QuestionStep::where('questionId', $questionId)->get();
        $userAnswers = Session::get('userAnswers', []);

        return view('summaryAnswer', compact('question', 'questionSteps', 'userAnswers'));
    }


}
