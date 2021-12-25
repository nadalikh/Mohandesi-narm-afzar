<?php

namespace App\Http;

use App\Models\movie;

class functions
{
     static function directorQuestion()
    {
        $movie = movie::all()->random(1)->first();
        $answers = $quiz = array();
        $answers[] = $movie::where('director', "!=", $movie->director)->inRandomOrder()->first();
        $answers[] = $movie::where([['director', "!=", $answers[0]->director],['director', "!=", $movie->director]])->inRandomOrder()->first();
        $answers[] = $movie::where([['director', "!=", $answers[1]->director],['director', "!=", $answers[0]->director],['director', "!=", $movie->director]])->inRandomOrder()->first();
        $answers[] = $movie;
        $quiz['answer'] = shuffle($answers);
        $quiz["question"] = movie::all()->random(1)->first();
        return $quiz;
    }
}
