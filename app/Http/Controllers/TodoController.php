<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use App\Models\User;
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
        $param = [
            'content' => $request->content,
            'tag_id' => $request->tag_id,
            'user_id' => Auth::user()->id
    ];
        Todo::create($param);

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
        $user = Auth::user();
        return view('/find', ['input' => '', 'user' => $user]);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();

        $content = $request->input('content');
        $tag_id = $request->input('tag_id');

        if (!empty($content)) {
            $todos->where('content', 'LIKE', "%{$content}%")->get();
        }

        if (!empty($tag_id)) {
            $todos->where('tag_id', $tag_id)->get();
        }

        $param = [
            'input' => $request->input,
            'content' => $content,
            'tag_id' => $tag_id,
            'user' => $user,
            'todos' => $todos,
            'tags' => $tags,
        ];

        return view('/find', $param);
    }
}