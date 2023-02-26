<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;

class TodoController extends Controller
{
    public function index()
    {

    }

    public function add(CreateRequest $request)
    {
        //dd($request->input('task'));
        $task = new Todo();
        $task->name = $request->input('name');
        $task->task = $request->input('task');

        $task->save();

        return redirect()->route('home')->with('success', 'Новая задача успешно добавлена');
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        //dd(Todo::all());
        return view('/ToDo/list', ['data' => Todo::/*all()*/paginate()]);

    }

    public function edit($id)
    {
        return view('/ToDo/edit', ['data' => Todo::find($id)]);
    }

    public function update($id)
    {
        return view('/ToDo/update', ['data' => Todo::find($id)]);
    }

    public function updateSubmit($id, CreateRequest $request)
    {
        //dd($request->input('task'));
        $task = Todo::find($id);
        $task->name = $request->input('name');
        $task->task = $request->input('task');

        $task->save();

        return redirect()->route('edit', $id)->with('success', 'Задача успешно обновлена');
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        return redirect()->route('list')->with('success', 'Задача успешно удалена!');
    }

    public function destroy(Todo $todo)
    {
        //
    }
}
