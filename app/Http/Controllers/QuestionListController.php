<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionStep;
use App\Models\QuestionResponse;
use App\Models\Difficulty;
use App\Models\Topic;
use App\Models\Formula;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class QuestionListController extends Controller
{
    public function questionListL(Request $request)
    {
        $search = $request->input('search');
        $searchLower = strtolower($search);
        $questions = Question::query();
        $message = null;

        if (!empty($search)) 
        {
            if (strpos($search, '%') !== false) 
            {
                $message = 'Data "' . $search . '" does not exist in the system!';
                $questions = [];
                return view('listQuestionL', compact('questions', 'message'));
            }

            $questions->where('questionTitle', 'LIKE', "%$searchLower%")
                ->orWhereHas('user', function ($query) use ($searchLower) 
                {
                    $query->whereRaw('LOWER(name) LIKE ?', ["%$searchLower%"]);
                })
                ->orWhereHas('topic', function ($query) use ($searchLower) 
                {
                    $query->whereRaw('LOWER(topicName) LIKE ?', ["%$searchLower%"]);
                })
                ->orWhereHas('difficulty', function ($query) use ($searchLower) 
                {
                    $query->whereRaw('LOWER(difficultyName) LIKE ?', ["%$searchLower%"]);
                });
        }

        $questions = $questions->get();

        return view('listQuestionL', compact('questions', 'message'));
    }

    public function questionListS(Request $request)
    {
        $search = $request->input('search');
        $searchLower = strtolower($search);
        $questions = Question::query();
        $message = null;

        if (!empty($search)) 
        {
            if (strpos($search, '%') !== false) 
            {
                $message = 'Data "' . $search . '" does not exist in the system!';
                $questions = [];
                return view('listQuestionS', compact('questions', 'message'));
            }

            $questions->where('questionTitle', 'LIKE', "%$searchLower%")
                ->orWhereHas('user', function ($query) use ($searchLower) 
                {
                    $query->whereRaw('LOWER(name) LIKE ?', ["%$searchLower%"]);
                })
                ->orWhereHas('topic', function ($query) use ($searchLower) 
                {
                    $query->whereRaw('LOWER(topicName) LIKE ?', ["%$searchLower%"]);
                })
                ->orWhereHas('difficulty', function ($query) use ($searchLower) 
                {
                    $query->whereRaw('LOWER(difficultyName) LIKE ?', ["%$searchLower%"]);
                });
        }

        $questions = $questions->get();

        return view('listQuestionS', compact('questions', 'message'));
    }

    public function destroyQuestion(Request $request, $questionId)
    {
        try {
            // Find the question by its ID
            $question = Question::findOrFail($questionId);

            // Delete related question responses
            $questionSteps = QuestionStep::where('questionId', $questionId)->get();
            $questionStepIds = $questionSteps->pluck('questionStepId');
            QuestionResponse::whereIn('questionStepId', $questionStepIds)->delete();

            // Delete related question steps
            QuestionStep::where('questionId', $questionId)->delete();

            // Delete the question
            $question->delete();

            return redirect()->back()->with('success', 'Question data successfully deleted.');
        } 
        catch (ModelNotFoundException $exception) 
        {
            return redirect()->back()->with('error', 'Question not found.');
        } 
        catch (\Exception $exception) 
        {
            return redirect()->back()->with('error', 'An error occurred while deleting the question.');
        }
    }

    //view question - lecturer
    public function viewQuestionL(Request $request, $questionId)
    {
        $questions = Question::findOrFail($questionId);
        $questionSteps = QuestionStep::where('questionId', $questionId)->get();

        return view('viewQuestionL', compact('questions', 'questionSteps'));
    }

    //view question - student
    public function viewQuestionS(Request $request, $questionId)
    {
        $questions = Question::findOrFail($questionId);
        $questionSteps = QuestionStep::where('questionId', $questionId)->get();

        return view('viewQuestionS', compact('questions', 'questionSteps'));
    }


}
