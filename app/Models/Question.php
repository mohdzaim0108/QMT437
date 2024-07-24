<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table ='question';
    protected $primaryKey ='questionId';
    public $incrementing = true;


    protected $fillable = [
        'questionId',
        'difficultyId',
        'lecturerId',
        'questionTitle',
        'question',
        'created_at',
        'updated_at',
    ];
 
    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class, 'difficultyId');
    }

    public function questionStep()
    {
        return $this->hasMany(QuestionStep::class, 'questionId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topicId');
    }
}
