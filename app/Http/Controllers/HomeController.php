<?php

namespace App\Http\Controllers;

use App\Models\movie;
use Illuminate\Http\Request;
use App\Http\functions;
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

    public function index(){
        $question = movie::all()->random(1)->first();
        $answers = functions::directorQuiz($question);
        dd($answers);
        return view('home', compact('question', "answers"));
    }
}
