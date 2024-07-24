<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Schedule;


class Difficulty extends Model
{
    use HasFactory;

    protected $table ='difficulty';
    protected $primaryKey ='difficultyId';


    public function question()
    {
        return $this->hasMany(Question::class, 'questionId');
    }

}

