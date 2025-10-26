<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','task_id','marks'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
