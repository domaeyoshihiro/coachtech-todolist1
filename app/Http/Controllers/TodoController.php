<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();

        $param = ['todos' => $todos,'tags' => $tags, 'user' => $user];
        return view('index', $param);
    }

public function create(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);

        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::find($request->id)->update($form);
        return redirect('/');
    }

    public function remove(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }

    public function find()
    {
        return view('/find', ['input' => '']);
    }

    public function search(Request $request)
    {
        $todo = Todo::where('content', 'LIKE BINARY',"%{$request->input}%")->get();
        $param = [
            'input' => $request->input,
            'todo' => $todo
        ];
        return view('/find', $param);
    }
}