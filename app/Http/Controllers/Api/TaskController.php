<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // List all tasks
    public function index() {
        $tasks = Task::all();
        return response()->json([
            'status' => 'Success',
            'data' => $tasks
        ]);
    }

    // Create a new task
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'marks' => 'required|integer|min:0'
        ]);

        $task = Task::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $task
        ], 201);
    }

    // Get a single task
    public function show($id) {
        $task = Task::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $task
        ]);
    }

    // Update a task
    public function update(Request $request, $id) {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'details' => 'nullable|string',
            'marks' => 'sometimes|required|integer|min:0'
        ]);

        $task->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $task
        ]);
    }

    // Delete a task
    public function destroy($id) {
        Task::destroy($id);

        return response()->json([
            'status' => 'Success',
            'data' => null
        ], 204);
    }
}
