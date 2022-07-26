<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'task' => 'required|string|min:3',
            'priority' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        Todo::create([
            'task' => $request->task,
            'priority' => $request->priority
        ]);

        return response()->json(['body' => 'La tâche a bien été crée']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $rules = [
            'task_id' => 'required',
            'task' => 'required|string|min:3',
            'priority' => 'required',
            'state' => 'required|min:0|max:1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $todo = Todo::findOrFail($request->task_id);
        $todo->task = $request->task;
        $todo->priority = $request->priority;
        $todo->state = $request->state;

        $todo->save();

        return response()->json(['body' => 'La tâche a bien été mis à jour']);
    }

    public function completeTask(Request $request)
    {
        $rules = [
            'task_id' => 'required|int',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $todo = Todo::findOrFail($request->task_id);
        $todo->state = !$todo->state;
        $todo->save();

        return back()->with('task_updating', 'La tâche a été mise à jour avec succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $todo = Todo::findOrFail($request->id);
        $todo->delete();

        return response()->json(['body' => 'Tâche supprimé avec succès']);
    }
}
