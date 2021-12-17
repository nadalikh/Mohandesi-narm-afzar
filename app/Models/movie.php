<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    use HasFactory;
    public function directorQuiz(){
        $answers = array();
        $answers[] = $this->director;
        $answers[] = $this::where(['director', "!=", $this->director])->first();
        $answers[] = $this::where(['director', "!=", $answers[0]->director])->first();
        $answers[] = $this::where(['director', "!=", $answers[1]->director])->first();
        shuffle($answers);
        return $answers;
//        $found = true;
//        while($found){
//            foreach($answers as $ans) {
//                foreach ($answers as $a)
//                    if ($a->director == $ans->director) {
//
//                    }
//            }
//        }
    }
}
