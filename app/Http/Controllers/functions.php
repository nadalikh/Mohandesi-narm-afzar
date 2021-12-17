<?php
use App\Models\movie;
class functions{
    static function directorQuiz($movie){
        $answers = array();
        $answers[] = $movie;
        $answers[] = $movie::where('director', "!=", $movie->director)->first();
        $answers[] = $movie::where('director', "!=", $answers[0]->director)->first();
        $answers[] = $movie::where('director', "!=", $answers[1]->director)->first();
        shuffle($answers);
        return $answers;
    }
}
