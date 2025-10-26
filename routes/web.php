<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    
});


 http://127.0.0.1:8000/api/task-submissions

 http://127.0.0.1:8000/api/task-submissions/student-wise

[

    "status" : "success",
    "data" [
     {
    "id" : 2,
    "student-name" : " Mamun",
    "phone" : "0144444",
    "total-submit" : 2,
    "total-marks" : 100,
    "rank" : 2
 },
  {
    "id" : 2,
    "student-name" : " Siddik",
    "phone" : "0144445",
    "total-submit" : 2,
    "total-marks" : 120,
    "rank" : 1
 }]
]