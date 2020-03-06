<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   //softDeletesというのが論理削除になる

class Todo extends Model
{
    use SoftDeletes;    //論理削除のため追加
    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];   //論理削除のため追加

    protected $fillable = [
        'title',
        'user_id'
    ];    //fillableとは、代入を許可する属性

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get(); //条件指定に沿った結果データの全てを取得。Query Builder
    }
}
