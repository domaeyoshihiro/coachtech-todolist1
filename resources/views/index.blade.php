<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
<style>
  body {
    font-size:16px;
    background-color: #191970;
  }
  h1 {
    font-size:20px;
    color: black;
    padding: 20px 20px 0;
  }
  .todolist {
    color: black;
    background-color: white;
  }
  .upper_table {
  }

  .textbox_add-btn {
    padding: 10px 20px 20px;
  }


</style>

<body>
  <div class="todolist">
    <div class="upper_table">
      <h1>Todo List</h1>
        <div class="textbox_add-btn">
          <ul>
            <li>
            {{$error}}
            </li>
          </ul>
      <form action="/add" method="POST">
      @csrf
      <input type="text" name="textbox" >
      <button type="submit" name="create-btn">追加</button>
      </form>
      </div>
    </div>
    <div class="bottom_table">
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
        <td>
          {{$todo->content}}
        </td>
        <td><form action="/edit" method="POST">
          <button type="submit" name="updata-btn">更新</button>
        </form>
        </td><form action="/delete" method="POST">
          <button type="submit" name="remove-btn">削除</button>
        </form>
        <td>
      </tr>
        @endforeach
      </table>
    </div>
  </div>
</body>
</html>