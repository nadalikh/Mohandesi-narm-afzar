<?php

namespace App\Http;

use App\Models\movie;

class functions
{
     static function directorQuestion()
    {
        $quiz["question"] = movie::all()->random(1)->first();
        $answers = $quiz = array();
        $answers[] = $quiz["question"]::where('director', "!=", $quiz["question"]->director)->inRandomOrder()->first();
        $answers[] = $quiz["question"]::where([['director', "!=", $answers[0]->director],['director', "!=", $quiz["question"]->director]])->inRandomOrder()->first();
        $answers[] = $quiz["question"]::where([['director', "!=", $answers[1]->director],['director', "!=", $answers[0]->director],['director', "!=", $quiz["question"]->director]])->inRandomOrder()->first();
        $answers[] = $quiz["question"];
        $quiz['answer'] = shuffle($answers);
        dd($quiz);
        return $quiz;
    }
}
