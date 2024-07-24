<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Schedule;


class Role extends Model
{
    use HasFactory;

    protected $table ='role';
    protected $primaryKey ='roleId';


    public function users()
    {
        return $this->hasMany(User::class);
    }

}

