<?php

namespace App\Http\Controllers;

use App\Models\QuestionAnswer;

class QuestionAnswerController extends Controller
{
    public function index(){
        $quesAnss = QuestionAnswer::all();
        return view('questionAnswer', compact('quesAnss'));
    }
}
