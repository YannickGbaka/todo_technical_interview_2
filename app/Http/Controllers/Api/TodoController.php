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

        $todo = Todo::create([
            'task' => $request->task,
            'state' => 0,
            'priority' => $request->priority
        ]);

        return response()->json(['body' => $todo, 'message' => 'Tâche crée avec succès']);
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
        $todo = Todo::findOrFail($id);
        return response()->json($todo, 201);
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
            'id' => 'required',
            'task' => 'required|string|min:3',
            'priority' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $todo = Todo::findOrFail($request->id);
        $todo->task = $request->task;
        if ($request->priority == 'Elévé' || $request->priority == 'Moyenne' || $request->priority == 'Faible') {
            switch ($request->priority) {
                case 'Elévé':
                    $todo->priority = 1;
                    break;
                case 'Moyenne':
                    $todo->priority = 2;
                    break;
                case 'Faible':
                    $todo->priority = 3;
                    break;
            }
        } else {
            $todo->priority = $request->priority;
        }
        if ($request->state == 'Terminé' || $request->state == 'En cours') {
            $todo->state = $todo->state;
        } else {
            $todo->state = $request->state;
        }

        $todo->save();

        return response()->json(['body' => $todo, 'message' => 'La tâche a bien été mis à jour']);
    }

    public function completeTask($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->state = !$todo->state;
        $todo->save();
        return $todo;

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
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['body' => 'Tâche supprimé avec succès']);
    }
}
