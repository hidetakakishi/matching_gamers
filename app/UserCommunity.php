<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCommunity extends Model
{
    protected $table = 'user_community';

    protected $fillable = ['user_id','community_id','interface','voicechat','server','rank'];
}
