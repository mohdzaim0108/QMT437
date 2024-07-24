<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionStep;
use App\Models\QuestionResponse;

class QuestionResponseController extends Controller
{
    public function showChart(Request $request)
    {
        $questionId = $request->input('questionId');
        $questionStepId = $request->input('questionStepId');

        // Fetch all questions and filter question steps based on selected questionId
        $Questions = Question::all();
        $QuestionSteps = $questionId ? QuestionStep::where('questionId', $questionId)->get() : collect();

        // Initialize the query builder for questions
        $query = Question::with(['questionStep.questionResponse' => function ($query) use ($questionStepId) {
            if ($questionStepId) {
                $query->where('questionStepId', $questionStepId);
            }
            $query->select('questionStepId', 'isAnswerTrue');
        }]);

        // Filter questions based on selected questionId
        if ($questionId) {
            $query->where('questionId', $questionId);
        }

        // Execute the query and get the results
        $questions = $query->get();

        // Initialize counts
        $trueCount = 0;
        $falseCount = 0;
        $hasResponses = false;

        // Prepare an array to store the count of responses for each step
        $stepCounts = [];

        // Process data
        foreach ($questions as $question) 
        {
            foreach ($question->questionStep as $step) 
            {
                if ($questionStepId && $step->questionStepId != $questionStepId) {
                    continue;
                }

                if ($step->questionResponse->isNotEmpty()) {
                    $hasResponses = true;
                }

                // Count the responses for the current step
                $stepCounts[$step->questionStepId] = $step->questionResponse->count();

                foreach ($step->questionResponse as $response) 
                {
                    if ($response->isAnswerTrue) 
                    {
                        $trueCount++;
                    } 
                    else 
                    {
                        $falseCount++;
                    }
                }
            }
        }

        // Prepare data for the chart
        $data = [
            'trueCount' => $trueCount,
            'falseCount' => $falseCount,
        ];

        // Get selected question title and step instruction
        $selectedQuestion = $Questions->firstWhere('questionId', $questionId);
        $selectedQuestionStep = $QuestionSteps->firstWhere('questionStepId', $questionStepId);

        return view('resultResponse', [
            'Questions' => $Questions,
            'QuestionSteps' => $QuestionSteps,
            'data' => json_encode($data),
            'hasResponses' => $hasResponses,
            'selectedQuestion' => $selectedQuestion,
            'selectedQuestionStep' => $selectedQuestionStep,
            'stepCounts' => $stepCounts
        ]);
    }


}
