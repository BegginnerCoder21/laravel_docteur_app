<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable  = ['category','status','experience','bio_data','patients','user_id'];

    public function user(){

        return  $this->belongsTo(User::class);
    }
}

