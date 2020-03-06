<?php

namespace App\Http\Controllers; //クラスのディレクトリ

use Illuminate\Http\Request;
use App\Todo;   //Todo Modelが使えるようになる
use Auth;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $instanceClass)    //コンストラクトは、このコントローラーが動く時に実行されるメソッド。モデルインスタンスの生成（Laravelではnewを書かなくてもここでインスタンスの生成）
    {
        $this->middleware('auth');  // ログイン状態を判断するミドルウェア。authミドルウェアを設定することで、ログインしている人だけがコントローラーのメソッドを実行できる
        $this->todo = $instanceClass;
    }

    //Eloquentエロクアントでのデータベース操作
    // https://laraweb.net/knowledge/748/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "Hello world!!";
        // return view('layouts.app'); //layoutsディレクトリのapp.blade.phpを返すように記述
        // return view('todo.index');
        // $todos = $this->todo->all(); //all()はSELECT * FROM todos;と同じ。全てのレコードの取得　返り値はコレクションインスタンスで。
        //dd($todos);
        // dd(compact('todos'));
        $todos = $this->todo->getByUserId(Auth::id());  //Authファサード。Auth::idのの::はアロー演算子のようなもの Auth::id()は現在ログインしているユーザーのID取得
        $user = Auth::user();
<<<<<<< HEAD
        // dd($userName);
=======
>>>>>>> 1_show_user_name
        return view('todo.index', compact('todos', 'user'));    //view('resources/viewsディレクトリ配下のファイル名','変数')
        // return view('todo.index', [ 'todos' => $todos ]);    //compactなしでかくと
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Form タグで送信した POST 情報を取得する
    {
        // dd($request);
        $input = $request->all();   //入力値の取り出し  ここは連想配列が返ってくる
        // dd($input);
        $input['user_id'] = Auth::id(); //inputにいれた入力値の連想配列の、,Keyのuser_idにログインしているユーザーのidをいれる
        // dd($input);
        $this->todo->fill($input)->save();  //save() でデータの保存
        // dd(redirect()->to('todo'));
        // return redirect()->to('todo');  //URItodoのページへ飛ぶ
        return redirect()->route('todo.index');  //URItodoのページへ飛ぶ
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id); //findはidの1レコード分の情報を持ったTodoクラス（Model）の新しいインスタンスが返り値。
        return view('todo.edit', compact('todo'));
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
        $input = $request->all();   //入力値を取り出す
        $this->todo->find($id)->fill($input)->save();   //findはidの1レコード分の情報を持ったTodoクラス（Model）の新しいインスタンスが返り値。fillは引数を設定できるか確認してfindで返ってきたインスタンスへ書き込むイメージ。Modelで定義しているのと確認。saveで保存をかける。
        // return redirect()->to('todo');
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)    //deleteはGETメソッドの仲間でURLからidが受け取れる
    {
        $this->todo->find($id)->delete();   //findはidの1レコード分の情報を持ったTodoクラス（Model）のインスタンスが返り値の為、アロー演算子でdeleteの実行ができる。
        // return redirect()->to('todo');
        return redirect()->route('todo.index');
    }
}
