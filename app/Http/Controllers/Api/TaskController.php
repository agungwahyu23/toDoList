<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request) 
    {
        $task = Task::where('user_id', $request->user()->id)->latest()->get();
        
        return response()->json($task);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'title' => 'string|max:255|required',
            'description' => 'string',
            'status' => 'boolean',
        ]);  

        if (!$validated) {
            return response()->json(['error' => 'Validation failed'], 422);
        }

        $task = Task::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? false,
        ]);

        return response()->json($task, 201);
    }

    public function show(Task $task) 
    {
        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($task);    
    }

    public function update(Request $request, Task $task) 
    {
        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validate([
            'title' => 'string|max:255|required',
            'description' => 'string',
            'status' => 'boolean',
        ]);  

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(Task $task) 
    {
        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Deleted']);
    }

    public function test() 
    {
        return response()->json('hello', 200);    
    }
}
