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

  .create__btn {
    border: 2px solid	#BA55D3;
    border-radius: 3px;
    background-color: white;
    color: #BA55D3;
    font-weight: bold;
    padding: 8px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .create__btn:hover {
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
    padding: 8px 15px;
    cursor: pointer;
    transition: .3s;
  }

  .delete__btn:hover {
    background-color:	#7FFFD4;
    color: white;
  }
</style>

<body>
  <div class="todolist">
    <div class="upper_main">
      <h1>Todo List</h1>
        <div class="textbox_add-btn">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
      <form action="/add" method="POST" class="upper__taskbox">
      @csrf
      <input type="text" name="content" class="task__text">
      <button type="submit" name="create-btn" class="create__btn">追加</button>
      </form>
    </div>
    <div class="bottom_main">
      <table>
        <tr>
          <th>作成日</th>
          <th>タスク名</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
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
      </table>
    </div>
  </div>
</div>
</body>
</html>