<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // List all students
    public function index() {
        $students = Student::all();
        return response()->json([
            'status' => 'Success',
            'data' => $students
        ]);
    }

    // Create a new student
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:students,phone',
            'email' => 'required|email|unique:students,email'
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $student
        ], 201);
    }

    // Get a single student
    public function show($id) {
        $student = Student::with('submissions')->findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $student
        ]);
    }

    // Update a student
    public function update(Request $request, $id) {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|unique:students,phone,' . $id,
            'email' => 'sometimes|required|email|unique:students,email,' . $id
        ]);

        $student->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $student
        ]);
    }

    // Delete a student
    public function destroy($id) {
        Student::destroy($id);

        return response()->json([
            'status' => 'Success',
            'data' => null
        ], 204);
    }
}
