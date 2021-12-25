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
        $quiz = functions::directorQuestion();
        dd($quiz);
        return view('home', compact('quiz'));
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
