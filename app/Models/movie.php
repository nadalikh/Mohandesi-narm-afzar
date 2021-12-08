<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    use HasFactory;
    public function directorQuiz(){
        $answers = $this::all()->random(3);
        $found = true;
        while($found){
            foreach($answers as $ans)
                foreach($answers as $a)
                    if($a->imdb_title_id == $ans->imdb_title_id){

                    }
        }
    }
}
