<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'user_id'
    ];    //fillableとは、代入を許可する属性

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get(); //条件指定に沿った結果データの全てを取得。Query Builder
    }
}
