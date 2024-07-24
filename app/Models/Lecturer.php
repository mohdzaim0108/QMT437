<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $table ='lecturer';
    protected $primaryKey ='lecturerId';

    protected $fillable = [
        'lecturerId',
        'userId',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, id);
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'lecturerId');
    }
}
 