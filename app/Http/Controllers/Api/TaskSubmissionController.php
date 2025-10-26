<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;
use App\Models\Student;
use App\Models\Task;

class TaskSubmissionController extends Controller
{
    public function index()
    {
        $submissions = TaskSubmission::with(['student', 'task'])->get();

        return response()->json([
            'status' => 'Success',
            'data' => $submissions
        ]);
    }

    public function show($id)
    {
        $submission = TaskSubmission::with(['student', 'task'])->findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $submission
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'task_id' => 'required|exists:tasks,id',
            'marks' => 'nullable|integer|min:0',
        ]);

        $submission = TaskSubmission::create($request->all());

        // Include student and task data
        $submission = TaskSubmission::with(['student', 'task'])->find($submission->id);

        return response()->json([
            'status' => 'Success',
            'data' => $submission
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $submission = TaskSubmission::findOrFail($id);
        $submission->update($request->all());

        $submission = TaskSubmission::with(['student', 'task'])->find($id);

        return response()->json([
            'status' => 'Success',
            'data' => $submission
        ]);
    }

    public function destroy($id)
    {
        TaskSubmission::destroy($id);

        return response()->json([
            'status' => 'Success',
            'data' => null
        ], 204);
    }

    public function studentWise()
    {
        // Get all students with their submissions
        $students = \App\Models\Student::with('submissions')->get();

        $summary = $students->map(function ($student) {
            return [
                'id' => $student->id,
                'student-name' => $student->name,
                'phone' => $student->phone,
                'total-submit' => $student->submissions->count(),
                'total-marks' => $student->submissions->sum('marks'),
            ];
        });

        // Sort descending by total-marks
        $sorted = $summary->sortByDesc('total-marks')->values();

        // Add rank
        $sorted->transform(function ($item, $index) {
            $item['rank'] = $index + 1;
            return $item;
        });

        return response()->json([
            'status' => 'Success',
            'data' => $sorted
        ]);
    }
}
