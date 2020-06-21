<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'community';

    protected $fillable = ['community_name','community_image','community_members',
                           'community_comment','interface_flag','voicechat_flag',
                           'serve_flag','rank_flag','level_flag','play_time_flag',
                           'user_id'];
}
