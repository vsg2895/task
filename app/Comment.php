<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function array_image(){

        $img_arr = [];
        $img_arr = explode(',',$this->image);
        return $img_arr;

    }
    public function comment_topic()
    {
        return $this->hasOne(Topic::class,'id','topic_id');
    }
    public function comment_user()
    {
        return $this->hasOne(User::class,'id','user_id')->withTrashed();
    }
}
