<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Todo::orderBy('created_at', 'DESC')->get();
        // return Todo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $newTodo = new Todo;
        $newTodo->title = $request->title;
        $newTodo->save();
        return $newTodo;
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
        return Todo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $editTodo = Todo::find($id);
        if ($editTodo) {
            $editTodo->is_completed = $request->is_completed ? 1 : 0;
            // $editTodo->title = $request->title;
            $editTodo->save();
            return $editTodo;
        } else {
            return "Todo not found";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $deleteTodo = Todo::find($id);
        // $nextTodo = Todo::find($id + 1);
        if ($deleteTodo) {
            $deleteTodo->delete();
            // $id -=1;
            return "Delete Success";
        } else {
            return "Todo not found";
        }
    }
}
