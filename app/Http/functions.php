<?php

namespace App\Http;

class functions
{
    static function directorQuiz($movie)
    {
        $answers = array();

        $answers[] = $movie::where('director', "!=", $movie->director)->inRandomOrder()->first();
        $answers[] = $movie::where([['director', "!=", $answers[0]->director],['director', "!=", $movie->director]])->inRandomOrder()->first();
        $answers[] = $movie::where([['director', "!=", $answers[1]->director],['director', "!=", $answers[0]->director],['director', "!=", $movie->director]])->inRandomOrder()->first();
        $answers[] = $movie;
        shuffle($answers);
        return $answers;
    }
}
