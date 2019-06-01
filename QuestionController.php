<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Feature;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuestionCreatedMail;

class QuestionController extends Controller
{
    public function showAllQuestions()
    {
        return response()->json(Question::all());
    }

    public function showOneQuestion($id)
    {
        return response()->json(Question::with(['feature'])->find($id));
    }

    public function create(Request $request)
    {
        $question = Question::create($request->all());
        $feature = Feature::find($question->feature);
        $isUpdated = 0;
        Mail::to('drughelp.carecsu@gmail.com')->send(new QuestionCreatedMail($question, $feature, $isUpdated));

        return response()->json($question, 201);
    }

    public function update($id, Request $request)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());

        $feature = Feature::find($question->feature);
        $isUpdated = 1;
        Mail::to('drughelp.carecsu@gmail.com')->send(new QuestionCreatedMail($question, $feature, $isUpdated));

        return response()->json($question, 200);
    }

    public function delete($id)
    {
        Question::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
