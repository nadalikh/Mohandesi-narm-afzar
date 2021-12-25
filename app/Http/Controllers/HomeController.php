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
        return view('home', compact('question', "answers"));
    }
    public function answerValidation(Request $request){
        $req = $request->validate([
            "director"=>"required",
            "movieId"=>"required"
        ]);
        $movie = movie::whereimdbTitleId($req['movieId'])->first();
        if($movie->imdb_title_id === $req['director'])
            $status = true;
        else
            $status = false;
        return view('home', compact('status'));
    }
}
