<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Schedule;


class QuestionResponse extends Model
{
    use HasFactory;

    protected $table ='questionresponse';
    protected $primaryKey ='questionResponseId';
    public $incrementing = true;

    protected $fillable = [
        'questionStepId',
        'questionStepId',
        'studentId',
        'isAnswerTrue',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'studentId');
    }

    public function questionStep()
    {
        return $this->belongsTo(QuestionStep::class, 'questionStepId');
    }

}

