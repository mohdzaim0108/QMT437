<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Http\Request;
use App\Models\Difficulty;
use App\Models\Topic;
use App\Models\Formula;
use App\Models\Question;
use App\Models\QuestionStep;
use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Validation\Rule;

class QuestionFormController extends Controller
{
    public function all()
    {
        $difficultys = Difficulty::all();
        $topics = Topic::all();
        $formulas = Formula::all();

        return view('questionForm', compact('difficultys', 'topics', 'formulas'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'difficultyId' => 'required|exists:difficulty,difficultyId',
            'topicId' => 'required|exists:topic,topicId',
            'questionTitle' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'steps' => 'required|array',
            'steps.*.instruction' => 'required|string|max:255',
            'steps.*.formulaId' => 'required|exists:formula,formulaId',
            'steps.*.answer' => 'required|numeric',
        ]);


        // Store new question with request data
        $question = new Question;
        $question->difficultyId = $request->difficultyId;
        $question->userId = Auth::id(); // Assuming lecturerId is the logged-in user's ID
        $question->topicId = $request->topicId;
        $question->questionTitle = $request->questionTitle;
        $question->question = $request->question;
        $question->save();

        // Add steps to the question using QuestionStep::create
        foreach ($request->steps as $step) 
        {
            $newStep = new QuestionStep;
            $newStep->questionId = $question->questionId;
            $newStep->instruction = $step['instruction'];
            $newStep->formulaId = $step['formulaId'];
            $newStep->answer = (double) $step['answer'];
            $newStep->save();
        }

        return redirect()->back()->with('success', 'Question added successfully');
    }

    
    //view to edit question - lecturer
    public function editQuestion(Request $request, $questionId)
    {
        $questions = Question::findOrFail($questionId);
        $questionSteps = QuestionStep::where('questionId', $questionId)->get();
        $difficultys = Difficulty::all();
        $topics = Topic::all();
        $formulas = Formula::all();

        return view('updateQuestion', compact('questions', 'questionSteps','difficultys', 'topics', 'formulas'));
    }
    //update question
    public function updateQuestion(Request $request, $questionId)
    {
        
        // Validate the incoming request data
        $request->validate([
            'difficultyId' => 'required|exists:difficulty,difficultyId',
            'topicId' => 'required|exists:topic,topicId',
            'questionTitle' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'steps' => 'required|array',
            'steps.*.instruction' => 'required|string|max:255',
            'steps.*.formulaId' => 'required|exists:formula,formulaId',
            'steps.*.answer' => 'required|numeric',
        ]);

        // update new question with request data 
        $question = Question::findOrFail($questionId);
        $question->difficultyId = $request->input('difficultyId');
        $question->userId = Auth::id(); // Assuming lecturerId is the logged-in user's ID
        $question->topicId = $request->input('topicId');
        $question->questionTitle = $request->input('questionTitle');
        $question->question = $request->input('question');
        $question->save();

        // Handle deletions
        $deletedSteps = $request->input('deletedSteps');
        if ($deletedSteps) 
        {
            $deletedStepIds = explode(',', $deletedSteps);
            QuestionStep::whereIn('questionStepId', $deletedStepIds)->delete();
        }

        // Update question steps
        foreach ($request->input('steps') as $step) 
        {
            if (isset($step['questionStepId']) && $step['questionStepId']) 
            {
                $questionStep = QuestionStep::findOrFail($step['questionStepId']);
            } 
            else 
            {
                $questionStep = new QuestionStep();
                $questionStep->questionId = $question->questionId;
            }
            
            $questionStep->instruction = $step['instruction'];
            $questionStep->formulaId = $step['formulaId'];
            $questionStep->answer = $step['answer'];
            $questionStep->save();
        }
        // Redirect or return a response
        return redirect()->back()->with('success', 'Question update successfully');
    }


    
}
