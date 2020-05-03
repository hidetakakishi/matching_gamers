<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityChat extends Model
{
    protected $table = 'community_chat';

    protected $fillable = ['user_id','community_id','comment'];
}
