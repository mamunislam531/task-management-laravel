<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title','details','marks'];

    public function submissions(){
        return $this->hasMany(TaskSubmission::class);
    }
}
