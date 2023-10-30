<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Arr;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Task::all();
        return view('list', ['tasks'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|regex:(^([a-zA-z ]+)?$)|max:255',
            'description' => 'nullable|regex:(^([a-zA-z ]+)?$)',
        ], [
            'title.required' => "Title is required.",
            'title.regex' => "Title must be string.",
            'title.max' => "Title is too long.",
            'description.regex' => "Description must be string."
        ]);

        $title = $request->input('title');
        $description = $request->input('description');

        $length = strlen($title);
        $priority = ($length <= 10) ? 1 : (($length <= 20) ? 2 : 3);

        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'status' => false,
        ]);
        
        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Task::where('id', $id)->get();
        return view('list', ['tasks' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Task::where('id', $id)->first();
        return view('create', ['tasks' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|regex:(^([a-zA-z ]+)?$)|max:255',
            'description' => 'nullable|regex:(^([a-zA-z ]+)?$)',
        ], [
            'title.required' => "Title is required.",
            'title.regex' => "Title must be string.",
            'title.max' => "Title is too long.",
            'description.regex' => "Description must be string."
        ]);


        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');

        $length = strlen($title);
        $priority = ($length <= 10) ? 1 : (($length <= 20) ? 2 : 3);

        Task::find($id)->update([
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'status' => $status,
        ]);

        return redirect('tasks')->withSuccess('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('tasks');
    }
}
