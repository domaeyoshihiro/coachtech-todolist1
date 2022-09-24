<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo List</title>
  <link rel="stylesheet" href="css/reset.css">
</head>

<style>
  body {
    font-size:16px;
    background-color: #191970;
    position: relative;
    height: 100vh;
    width: 100vw;
  }
  h1 {
    font-size: 25px;
    color: black;
    padding-bottom: 20px;
  }

  .todolist {
    color: black;
    background-color: white;
    border-radius: 10px;
    width: 50vw;
    padding: 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
  }

  .upper__taskbox {
    padding-bottom: 30px;
    display: flex;
    justify-content: space-between;
  }

  .task__text {
    border: 1px solid	#DCDCDC;
    border-radius: 3px;
    width: 80%;
    height: 30px;
  }

  .search__btn {
    border: 2px solid	#BA55D3;
    border-radius: 3px;
    background-color: white;
    color: #BA55D3;
    font-weight: bold;
    font-size: 12px;
    padding: 8px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .search__btn:hover {
    background-color:	#BA55D3;
    color: white;
  }

  table {
    text-align: center;
    width: 100%;
  }

  tr {
    height: 50px;
  }

  .content__text {
    border: 1px solid	#DCDCDC;
    border-radius: 3px;
    width: 90%;
    height: 30px;
  }

  .update__btn {
    border: 2px solid #FF6347;
    border-radius: 3px;
    background-color: white;
    color: #FF6347;
    font-weight: bold;
    font-size: 12px;
    padding: 8px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .update__btn:hover {
    background-color: #FF6347;
    color: white;
  }

  .delete__btn {
    border: 2px solid #7FFFD4;
    border-radius: 3px;
    background-color: white;
    color: #7FFFD4;
    font-weight: bold;
    font-size: 12px;
    padding: 8px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .delete__btn:hover {
    background-color:	#7FFFD4;
    color: white;
  }

  .todo__header {
  display: flex;
  justify-content: space-between;
  }

  .login__header {
    display: flex;
  }

  .login__detail {
    padding-right: 15px;
    margin-top:10px;
  }

  .logout__btn {
    border: 2px solid #FF0000;
    border-radius: 3px;
    background-color: white;
    color: #FF0000;
    font-weight: bold;
    font-size: 12px;
    padding: 8px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .logout__btn:hover {
    background-color:	#FF0000;
    color: white;
  }

  .back__btn {
    border: 2px solid	#696969;
    border-radius: 3px;
    background-color: white;
    color: #696969;
    font-weight: bold;
    font-size: 12px;
    padding: 5px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .back__btn:hover {
    background-color:	#696969;
    color: white;
  }

  .task__tag {
    border: 1px solid	#DCDCDC;
    border-radius: 3px;
    padding: 0 8px;
  }

  .tag__td {
    border: 1px solid	#DCDCDC;
    border-radius: 3px;
    font-size: 14px;
    padding: 0 10px;
    height: 35px;
  }


</style>

<body>
  <div class="todolist">
    <div class="upper_main">
      <div class="todo__header">
        <h1>タスク検索</h1>
          <div class="login__header">
            @if (Auth::check())
              <p class="login__detail">「{{$user->name}}」でログイン中</p>
            @else
              <p class="login__detail">ログインしてください（<a href="/login">ログイン</a>|<a href="/register">登録</a>）</p>
            @endif
            <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" name="lgout-btn" class="logout__btn">ログアウト</button>
            </form>
          </div>
      </div>

        <div class="textbox_add-btn">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>

          <form action="{{ route('search') }}" method="GET" class="upper__taskbox">
            @csrf
            <input type="text" name="input" value="{{$input}}" class="task__text">
            
            <select name="tag_id" class="task__tag">
              <option value=""></option>
              <option value="1">家事</option>
              <option value="2">勉強</option>
              <option value="3">運動</option>
              <option value="4">食事</option>
              <option value="5">移動</option>
            </select>
          
            <button type="submit" name="search-btn" class="search__btn">検索</button>
          </form>
      
    </div>
    <div class="bottom_main">
      <table>
        <tr>
          <th>作成日</th>
          <th>タスク名</th>
          <th>タグ</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        
        @if (@isset($todo))
        @foreach ($todos as $todo)

        <tr>
          <td>
            {{$todo->created_at}}
          </td>
          <form action="/edit/{{ $todo->id }}" method="POST">
            @csrf
          <td>
            <input type="text" name="content" value="{{$todo->content}}" class="content__text">
          </td>

          <td>
            <select  name="tag_id" class="tag__td">
              @foreach($tags as $tag)
                @if ($todo->tag_id == $tag->id)
                  <option value="{{ $tag->id }}" selected="selected">{{ $tag->tag }}</option>
                @else
                  <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                @endif
              @endforeach
            </select>
          </td>

          <td>
            <button type="submit" name="update-btn" class="update__btn">更新</button>
          </td>
          </form>
          <td><form action="/delete/{{ $todo->id }}" method="POST">
            @csrf
            <button type="submit" name="remove-btn" class="delete__btn">削除</button>
          </form>
          </td>
        </tr>
        @endforeach
        @endif
      </table>
    </div>
  </div>
    <form action="/" method="GET" class="back-btn">
      @csrf
      <button type="submit" name="back-btn" class="back__btn">戻る</button>
    </form>
</div>
</body>
</html>