<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Schedule;


class Formula extends Model
{
    use HasFactory;

    protected $table ='formula';
    protected $primaryKey ='formulaId';


    public function questionStep()
    {
        return $this->hasMany(QuestionStep::class, 'questionStepId');
    }

}

