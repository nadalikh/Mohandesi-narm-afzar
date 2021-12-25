<?php

namespace App\Http;

use App\Models\movie;

class functions
{
     static function directorQuestion()
    {
        $answers = $quiz = array();
        $quiz["question"] = movie::all()->random(1)->first();
        $answers[] = $quiz["question"]::where('director', "!=", $quiz["question"]->director)->inRandomOrder()->first();
        $answers[] = $quiz["question"]::where([['director', "!=", $answers[0]->director],['director', "!=", $quiz["question"]->director]])->inRandomOrder()->first();
        $answers[] = $quiz["question"]::where([['director', "!=", $answers[1]->director],['director', "!=", $answers[0]->director],['director', "!=", $quiz["question"]->director]])->inRandomOrder()->first();
        $answers[] = $quiz["question"];
        shuffle($answers);
        $quiz['answer'] = $answers;
        return $quiz;
    }
}
