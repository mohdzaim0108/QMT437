<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Schedule;


class Topic extends Model
{
    use HasFactory;

    protected $table ='topic';
    protected $primaryKey ='topicId';


    public function question()
    {
        return $this->hasMany(Question::class, 'questionId');
    }

}

