<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Exam;
use App\Models\ExamQuestionLists;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //make user get random 20 question
    public function createExam(Request $request)
    {
        // Check if an exam already exists for the user
        $existingExam = Exam::where('user_id', $request->user()->id)->first();

        if ($existingExam) {
            return response()->json([
                'message' => 'Exam already created for this user',
                'exam' => $existingExam,
            ]);
        }

        $questionSigns = Question::where('category', 'Signs')->inRandomOrder()->limit(10)->get();
        $questionGeneric = Question::where('category', 'Generic')->inRandomOrder()->limit(10)->get();
        $questionPsychologist = Question::where('category', 'Psychologist')->inRandomOrder()->limit(10)->get();

        // Create exam and set timers
        $exam = Exam::create([
            'user_id' => $request->user()->id,
            'timer_signs' => 5,
            'timer_generic' => 5,
            'timer_psychologist' => 5,
        ]);

        // Create exam details
        foreach ($questionSigns as $question) {
            ExamQuestionLists::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
            ]);
        }

        foreach ($questionGeneric as $question) {
            ExamQuestionLists::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
            ]);
        }

        foreach ($questionPsychologist as $question) {
            ExamQuestionLists::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
            ]);
        }

        return response()->json([
            'message' => 'Exam created successfully',
            'exam' => $exam,
        ]);
    }


    //get exam by category
    public function getListSoalByCategory(Request $request)
    {
        $exam = Exam::where('user_id', $request->user()->id)->first();
        if (!$exam) {
            return response()->json([
                'message' => 'Exam not found',
                'data' => [],
            ], 200);
        }

        $examQuestionLists = ExamQuestionLists::where('exam_id', $exam->id)->get();
        $examQuestionListsId = $examQuestionLists->pluck('question_id');

        $question = Question::whereIn('id', $examQuestionListsId)->where('category', $request->category)->get();
        //timer by category
        //status by category
        $status = $exam->status_signs;
        $timer = $exam->timer_signs;
        if ($request->category == 'Generic') {
            $status = $exam->status_generic;
            $timer = $exam->timer_generic;
        } elseif ($request->category == 'Psychologist') {
            $status = $exam->status_psychologist;
            $timer = $exam->timer_psychologist;
        }

        return response()->json([
            'message' => 'Get Question Success',
            'timer' => $timer,
            'status' => $status,
            'data' => QuestionResource::collection($question),
        ]);
    }

    public function getAllScore(Request $request)
    {
        $exams = Exam::where('user_id', $request->user()->id)->get();

        $transformedData = [];
        foreach ($exams as $exam) {

            if ($exam->status_signs == 'done') {
                //add correct and incorrect answer Signs
                $examQuestionLists = ExamQuestionLists::where('exam_id', $exam->id)->get();
                $examQuestionLists = $examQuestionLists->filter(function ($value, $key) {
                    return $value->question->category == 'Signs';
                });
                $totalCorrectAnswer = $examQuestionLists->where('answer', true)->count();
                $totalIncorrectAnswer = $examQuestionLists->where('answer', false)->count();

                $transformedData[] = [
                    'category' => 'Signs Test',
                    'score' => $exam->score_signs,
                    'status' => 'done',
                    'correct_answer' => $totalCorrectAnswer,
                    'incorrect_answer' => $totalIncorrectAnswer,
                ];
            }

            if ($exam->status_generic == 'done') {
                //add correct and incorrect answer Generic
                $examQuestionLists = ExamQuestionLists::where('exam_id', $exam->id)->get();
                $examQuestionLists = $examQuestionLists->filter(function ($value, $key) {
                    return $value->question->category == 'Generic';
                });
                $totalCorrectAnswer = $examQuestionLists->where('answer', true)->count();
                $totalIncorrectAnswer = $examQuestionLists->where('answer', false)->count();
                $transformedData[] = [
                    'category' => 'Generic Test',
                    'score' => $exam->score_generic,
                    'status' => 'done',
                    'correct_answer' => $totalCorrectAnswer,
                    'incorrect_answer' => $totalIncorrectAnswer,

                ];
            }
            if ($exam->status_psychologist == 'done') {
                //add correct and incorrect answer Psychologist
                $examQuestionLists = ExamQuestionLists::where('exam_id', $exam->id)->get();
                $examQuestionLists = $examQuestionLists->filter(function ($value, $key) {
                    return $value->question->category == 'Psychologist';
                });
                $totalCorrectAnswer = $examQuestionLists->where('answer', true)->count();
                $totalIncorrectAnswer = $examQuestionLists->where('answer', false)->count();

                $transformedData[] = [
                    'category' => 'Psychologist Test',
                    'score' => $exam->score_psychologist,
                    'status' => 'done',
                    'correct_answer' => $totalCorrectAnswer,
                    'incorrect_answer' => $totalIncorrectAnswer,
                ];
            }
        }
        return response()->json([
            'message' => 'Get All Exam Success',
            'data' => $transformedData,
        ]);
    }


    //asnwering question
    public function answerQuestion(Request $request)
    {
        $validatedData = $request->validate([
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        $exam = Exam::where('user_id', $request->user()->id)->first();
        if (!$exam) {
            return response()->json([
                'message' => 'Exam not found',
                'data' => [],
            ], 200);
        }
        $examQuestionList = ExamQuestionLists::where('exam_id', $exam->id)->where('question_id', $validatedData['question_id'])->first();
        $question = Question::where('id', $validatedData['question_id'])->first();

        //check answer
        if ($question->answer == $validatedData['answer']) {
            $examQuestionList->update(
                ['answer' => true]
            );
        } else {
            $examQuestionList->update(
                ['answer' => false]
            );
        }

        return response()->json([
            'message' => 'Answer question successfully',
            'answer' => $examQuestionList->answer,
        ]);
    }

    //calculate exam scores by category
    public function calculateScoreByCategory(Request $request)
    {
        $category =  $request->category;
        $exam = Exam::where('user_id', $request->user()->id)->first();
        if (!$exam) {
            return response()->json([
                'message' => 'Exam not found',
                'data' => [],
            ], 200);
        }
        $examQuestionList = ExamQuestionLists::where('exam_id', $exam->id)->get();
        //questionlist by category
        $examQuestionList = $examQuestionList->filter(function ($value, $key) use ($category) {
            return $value->question->category == $category;
        });

        //calculate score
        $totalCorrectAnswer = $examQuestionList->where('answer', true)->count();
        $totalIncorrectAnswer = $examQuestionList->where('answer', false)->count();

        $totalQuestion = $examQuestionList->count();
        $score = ($totalCorrectAnswer / $totalQuestion) * 100;
        $category_field = 'score_signs';
        $status_field = 'status_signs';
        $timer_field = 'timer_signs';
        if ($category == 'Generic') {
            $category_field = 'score_generic';
            $status_field = 'status_generic';
            $timer_field = 'timer_generic';
        } else if ($category == 'Psychologist') {
            $category_field = 'score_psychologist';
            $status_field = 'status_psychologist';
            $timer_field = 'timer_psychologist';
        }
        $exam->update([
            $category_field => $score,
            $status_field => 'done',
            $timer_field => 0,
        ]);

        return response()->json([
            'message' => 'Get score successfully',
            'score' => $score,
            'CorrectAnswer' => $totalCorrectAnswer,
            'IncorrectAnswer' => $totalIncorrectAnswer,
        ], 200);
    }
}
