<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friend';

    protected $fillable = ['post_user_id','send_user_id','status'];
}
