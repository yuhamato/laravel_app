@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!} <!-- FormファサードopenでFormタグの生成。デフォルトでトークンの生成。 HtmlStringというクラスが返ってくる--> 
  <!--<form method="POST" action="http://127.0.0.1:8000/todo" accept-charset="UTF-8">-->
  <!--<input name="_token" type="hidden" value="P6dv1CNbUb91p1Tu67R40l0teTKmxjzFTmetYuG6">-->
  <div class="form-group">
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
    <!-- Form::input('type','name名',初期値,['id' => 'id名','class' => 'クラス名']) -->
    <!-- <input required class="form-control" placeholder="Todo内容" name="title" type="text"-->
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
  <!-- <input class="btn btn-success float-right" type="submit" value="追加"> -->
{!! Form::close() !!} <!-- </form> -->

@endsection