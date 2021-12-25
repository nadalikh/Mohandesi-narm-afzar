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

    public function index($status = null){
        $quiz = functions::directorQuestion();
        return view('home', compact('quiz', "status"));
    }
    public function answerValidation(Request $request){
        $req = $request->validate([
            "director"=>"required",
            "movieId"=>"required"
        ]);
        $movie = movie::whereimdbTitleId($req['movieId'])->first();
        if($movie->director === $req['director'])
            $status = true;
        else
            $status = false;
        return $this->index($status);
    }
}
