<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionStep extends Model
{
    use HasFactory;

    protected $table ='questionstep';
    protected $primaryKey ='questionStepId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'questionStepId',
        'questionId',
        'formulaId',
        'instruction',
        'answer',

    ];
 
    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }

    public function questionResponse()
    {
        return $this->hasMany(QuestionResponse::class, 'questionStepId');
    }
    

    public function formula()
    {
        return $this->belongsTo(Formula::class, 'formulaId');
    }


}
