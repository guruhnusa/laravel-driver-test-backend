<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::paginate(10);
        return view('pages.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('pages.questions.create');
    }

    public function store(StoreQuestionRequest $request)
    {
        $data = $request->all();

        Question::create($data);
        return redirect()->route('questions.index')->with('success', 'Question successfully created');
    }
}
