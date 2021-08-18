<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;
// use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }


    public function create()
    {
        return view('todo.create');
    }

    // public function store(Request $request)
    // {
    //     $inputs = $request->all();
    //     $this->todo->fill($inputs);
    //     $this->todo->save();
    //     return redirect()->route('todo.index');
    // }

    public function store(TodoRequest $request)
    {
        // dd($request);
        $inputs = $request->all();
        // dd($this->todo); 
        $this->todo->fill($inputs);
        // dd($this->todo);
        $this->todo->save();
        return redirect()->route('todo.index');
    }

    public function index()
    {
        $todos = $this->todo->all();
        // dd($todos);
        return view('todo.index', ['todos' => $todos]);
    }

    public function show($id)
    {
        // dd($id);
        $todo = $this->todo->find($id);
        return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.edit', ['todo' => $todo]);
    }

    // public function update(Request $request, $id)
    // {
    //     $inputs = $request->all();
    //     $todo = $this->todo->find($id);
    //     $todo->fill($inputs);
    //     $todo->save();
    //     // dd($this->todo->id, $todo->id);
    //     return redirect()->route('todo.show', $todo->id);
    // }

    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs);
        $todo->save();
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();
        return redirect()->route('todo.index');
    }
}
