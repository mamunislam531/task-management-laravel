<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;
 
class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone','email'];

    public function submissions(){
        return $this->hasMany(TaskSubmission::class);
    }
}

