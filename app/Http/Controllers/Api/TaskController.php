<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzClient;

class TaskController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum'); // Pastikan middleware auth aktif
    }
    
    public function index(Request $request) 
    {
        $query = Task::where('user_id', $request->user()->id);

        if ($request->has('status') && $request->status !== '' && $request->status !== null) {
            $query->where('status', $request->status);
        }
    
        $task = $query->latest()->get();
        
        return response()->json($task);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'title' => 'string|max:255|required',
            'description' => 'string',
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

    public function fetchQuotes() {

        $client = new GuzClient();
        $quotes=[];

        $request  =  $client->get('http://api.forismatic.com/api/1.0/?method=getQuote&format=json&lang=en');
        $data     = json_decode($request->getBody()->getContents());
        $quotes[] = $data->quoteText . "-" . $data->quoteAuthor;
 
        $client   = new GuzClient();
        $request  = $client->get('https://favqs.com/api/qotd');
        $data     = json_decode($request->getBody()->getContents());
        $quotes[] = $data->quote->body . "-" . $data->quote->author;

        return response()->json($quotes);
    }
}
